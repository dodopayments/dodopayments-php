<?php

declare(strict_types=1);

namespace Dodopayments\WorkloadIdentity;

use Dodopayments\Core\Util;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

/**
 * Subject token sources for workload identity.
 *
 * Each source is a closure that the client calls on each token exchange. The
 * client gives it the base URL.
 */
final class Providers
{
    public const TOKEN_FILE_ENV = 'DODO_PAYMENTS_IDENTITY_TOKEN_FILE';

    public const KUBERNETES_TOKEN_PATH = '/var/run/secrets/tokens/dodo-token';

    /**
     * Gets the OIDC token of the GitHub Actions job. The job must have the "id-token: write" permission.
     *
     * @param string|null $audience the default is the origin of the client base URL
     *
     * @return \Closure(string): string
     */
    public static function githubActions(
        ?string $audience = null,
        ?ClientInterface $httpClient = null
    ): \Closure {
        return static function (string $baseUrl) use ($audience, $httpClient): string {
            $url = self::env('ACTIONS_ID_TOKEN_REQUEST_URL');
            $requestToken = self::env('ACTIONS_ID_TOKEN_REQUEST_TOKEN');
            $separator = str_contains($url, '?') ? '&' : '?';
            $body = self::get(
                $httpClient,
                url: $url.$separator.'audience='.rawurlencode($audience ?? self::origin($baseUrl)),
                headers: ['Authorization' => "bearer {$requestToken}"],
            );

            $decoded = json_decode($body, associative: true);
            if (!is_array($decoded) || !is_string($value = $decoded['value'] ?? null) || '' === $value) {
                throw new WorkloadIdentityException('The GitHub Actions OIDC response has no "value" field.');
            }

            return $value;
        };
    }

    /**
     * Reads the GitLab CI ID token from an environment variable.
     *
     * @return \Closure(string): string
     */
    public static function gitlab(string $envVar = 'DODO_PAYMENTS_ID_TOKEN'): \Closure
    {
        return static fn (string $baseUrl): string => self::env($envVar);
    }

    /**
     * Reads the Terraform Cloud workload identity token.
     *
     * @return \Closure(string): string
     */
    public static function terraformCloud(): \Closure
    {
        return static fn (string $baseUrl): string => self::optionalEnv('TFC_WORKLOAD_IDENTITY_TOKEN_DODO')
            ?? self::env('TFC_WORKLOAD_IDENTITY_TOKEN');
    }

    /**
     * Gets an identity token from the GCP metadata server.
     *
     * @param string|null $audience the default is the origin of the client base URL
     *
     * @return \Closure(string): string
     */
    public static function gcp(
        ?string $audience = null,
        ?ClientInterface $httpClient = null
    ): \Closure {
        return static fn (string $baseUrl): string => self::nonEmpty(trim(self::get(
            $httpClient,
            url: 'http://metadata.google.internal/computeMetadata/v1/instance/service-accounts/default/identity?audience='
                .rawurlencode($audience ?? self::origin($baseUrl)).'&format=full',
            headers: ['Metadata-Flavor' => 'Google'],
        )), source: 'GCP metadata server');
    }

    /**
     * Reads the Vercel OIDC token.
     *
     * @return \Closure(string): string
     */
    public static function vercel(): \Closure
    {
        return static fn (string $baseUrl): string => self::env('VERCEL_OIDC_TOKEN');
    }

    /**
     * Reads a projected Kubernetes service account token on each exchange.
     *
     * @return \Closure(string): string
     */
    public static function kubernetes(string $path = self::KUBERNETES_TOKEN_PATH): \Closure
    {
        return static fn (string $baseUrl): string => self::readFile($path);
    }

    /**
     * Reads a token file on each exchange.
     *
     * @param string|null $path the default is the DODO_PAYMENTS_IDENTITY_TOKEN_FILE environment variable
     *
     * @return \Closure(string): string
     */
    public static function file(?string $path = null): \Closure
    {
        return static fn (string $baseUrl): string => self::readFile($path ?? self::env(self::TOKEN_FILE_ENV));
    }

    /**
     * Wraps your function that returns a JWT, for example from AWS STS GetWebIdentityToken.
     *
     * @param callable(string): string $fn
     *
     * @return \Closure(string): string
     */
    public static function aws(callable $fn): \Closure
    {
        return static fn (string $baseUrl): string => self::nonEmpty($fn($baseUrl), source: 'AWS token function');
    }

    /**
     * Returns the same token each time. Use it for tests.
     *
     * @return \Closure(string): string
     */
    public static function static(string $token): \Closure
    {
        return static fn (string $baseUrl): string => $token;
    }

    /**
     * Finds a token source from the environment. The order is GitHub Actions,
     * Terraform Cloud, DODO_PAYMENTS_IDENTITY_TOKEN_FILE, and the Kubernetes default path.
     *
     * @return (\Closure(string): string)|null null if there is no source
     */
    public static function auto(?ClientInterface $httpClient = null): ?\Closure
    {
        return match (true) {
            null !== self::optionalEnv('ACTIONS_ID_TOKEN_REQUEST_URL')
                && null !== self::optionalEnv('ACTIONS_ID_TOKEN_REQUEST_TOKEN') => self::githubActions(httpClient: $httpClient),
            null !== self::optionalEnv('TFC_WORKLOAD_IDENTITY_TOKEN_DODO')
                || null !== self::optionalEnv('TFC_WORKLOAD_IDENTITY_TOKEN') => self::terraformCloud(),
            null !== self::optionalEnv(self::TOKEN_FILE_ENV) => self::file(),
            is_file(self::KUBERNETES_TOKEN_PATH) => self::kubernetes(),
            default => null,
        };
    }

    private static function optionalEnv(string $name): ?string
    {
        $value = Util::getenv($name);

        return null === $value || '' === $value ? null : $value;
    }

    private static function env(string $name): string
    {
        return self::optionalEnv($name) ?? throw new WorkloadIdentityException("The {$name} environment variable is not set.");
    }

    private static function readFile(string $path): string
    {
        $contents = is_file($path) && is_readable($path) ? file_get_contents($path) : false;
        if (false === $contents) {
            throw new WorkloadIdentityException("Cannot read the token file {$path}.");
        }

        return self::nonEmpty(trim($contents), source: "token file {$path}");
    }

    private static function nonEmpty(string $token, string $source): string
    {
        if ('' === $token) {
            throw new WorkloadIdentityException("The {$source} returned an empty token.");
        }

        return $token;
    }

    private static function origin(string $baseUrl): string
    {
        $parts = parse_url($baseUrl);
        if (!is_array($parts) || !isset($parts['scheme'], $parts['host'])) {
            return rtrim($baseUrl, '/');
        }

        return $parts['scheme'].'://'.$parts['host'].(isset($parts['port']) ? ':'.$parts['port'] : '');
    }

    /**
     * @param array<string,string> $headers
     */
    private static function get(
        ?ClientInterface $httpClient,
        string $url,
        array $headers
    ): string {
        $request = Psr17FactoryDiscovery::findRequestFactory()->createRequest('GET', $url);
        foreach ($headers as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        try {
            $response = ($httpClient ?? Psr18ClientDiscovery::find())->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            throw new WorkloadIdentityException('The subject token request failed.', previous: $e);
        }

        if (200 !== $response->getStatusCode()) {
            throw new WorkloadIdentityException(sprintf('The subject token request returned HTTP %d.', $response->getStatusCode()));
        }

        return (string) $response->getBody();
    }
}
