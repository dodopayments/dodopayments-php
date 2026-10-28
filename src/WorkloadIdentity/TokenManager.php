<?php

declare(strict_types=1);

namespace Dodopayments\WorkloadIdentity;

use Dodopayments\Client;
use Dodopayments\Core\Util;

/**
 * Caches the workload identity access token of a client.
 *
 * The client gets a new token when 300 seconds or less remain. PHP sends the
 * requests of a client one at a time, so each refresh does one exchange.
 */
final class TokenManager
{
    public const TOKEN_PATH = 'workload-identity/token';

    public const REVOKE_PATH = 'workload-identity/token/revoke';

    public const REFRESH_WINDOW_SECONDS = 300;

    private ?string $accessToken = null;

    private int $expiresAt = 0;

    /**
     * @internal
     */
    public function __construct(
        private readonly Client $client,
        private readonly WorkloadIdentity $options,
        private readonly string $baseUrl,
    ) {}

    /**
     * @internal
     *
     * Returns the cached access token, or exchanges a new one
     */
    public function accessToken(): string
    {
        if (null !== $this->accessToken && $this->expiresAt - time() > self::REFRESH_WINDOW_SECONDS) {
            return $this->accessToken;
        }

        return $this->exchange();
    }

    /**
     * @internal
     *
     * Returns the cached access token without a freshness check. Client::request() refreshes it first.
     */
    public function currentAccessToken(): string
    {
        return $this->accessToken ?? $this->exchange();
    }

    /**
     * @internal
     */
    public function invalidate(): void
    {
        $this->accessToken = null;
        $this->expiresAt = 0;
    }

    /**
     * Revokes the cached access token and clears the cache.
     * It does nothing if there is no cached token.
     */
    public function revoke(): void
    {
        $token = $this->accessToken;
        if (null === $token) {
            return;
        }

        try {
            $this->client->sendWorkloadIdentityRequest(self::REVOKE_PATH, body: null, accessToken: $token);
        } finally {
            $this->invalidate();
        }
    }

    private function exchange(): string
    {
        $this->invalidate();

        $subjectToken = ($this->options->provider)($this->baseUrl);
        if ('' === $subjectToken) {
            throw new WorkloadIdentityException('The subject token provider returned an empty token.');
        }

        $response = $this->client->sendWorkloadIdentityRequest(
            self::TOKEN_PATH,
            body: [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:token-exchange',
                'subject_token_type' => 'urn:ietf:params:oauth:token-type:jwt',
                'subject_token' => $subjectToken,
                'identity_provider_id' => $this->options->identityProviderId,
            ],
            accessToken: null,
        );

        $decoded = Util::decodeJson((string) $response->getBody());
        if (!is_array($decoded) || !is_string($token = $decoded['access_token'] ?? null) || '' === $token) {
            throw new WorkloadIdentityException('The token exchange response has no access_token.');
        }

        $this->expiresAt = self::expiresAt($decoded);
        $this->accessToken = $token;

        return $token;
    }

    /**
     * @param array<mixed> $response
     */
    private static function expiresAt(array $response): int
    {
        $expiresAt = $response['expires_at'] ?? null;
        if (is_string($expiresAt) && false !== ($timestamp = strtotime($expiresAt))) {
            return $timestamp;
        }

        $expiresIn = $response['expires_in'] ?? null;
        if (is_int($expiresIn) || is_float($expiresIn)) {
            return time() + (int) $expiresIn;
        }

        return 0;
    }
}
