<?php

namespace Tests;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\AuthenticationException;
use Dodopayments\Core\Exceptions\PermissionDeniedException;
use Dodopayments\Core\Util;
use Dodopayments\WorkloadIdentity\Providers;
use Dodopayments\WorkloadIdentity\TokenManager;
use Dodopayments\WorkloadIdentity\WorkloadIdentity;
use Dodopayments\WorkloadIdentity\WorkloadIdentityException;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client as MockClient;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
#[CoversNothing]
class WorkloadIdentityTest extends TestCase
{
    private const SUBJECT_TOKEN = 'subject.jwt.fixture';

    #[Test]
    public function testExchangeThenBearerOnApiCall(): void
    {
        $mock = new MockClient;
        $mock->addResponse($this->token('at_1', expiresIn: 3600));
        $mock->addResponse($this->json(200, []));

        $client = $this->client($mock);
        $client->misc->listSupportedCountries();

        $requests = $mock->getRequests();
        $this->assertCount(2, $requests);

        $exchange = $requests[0];
        $this->assertSame('POST', $exchange->getMethod());
        $this->assertSame('/'.TokenManager::TOKEN_PATH, $exchange->getUri()->getPath());
        $this->assertFalse($exchange->hasHeader('Authorization'));
        $this->assertSame(
            [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:token-exchange',
                'subject_token_type' => 'urn:ietf:params:oauth:token-type:jwt',
                'subject_token' => self::SUBJECT_TOKEN,
                'identity_provider_id' => 'wip_test',
            ],
            json_decode((string) $exchange->getBody(), associative: true),
        );

        $this->assertSame('Bearer at_1', $requests[1]->getHeaderLine('Authorization'));
    }

    #[Test]
    public function testConcurrentCallsShareOneExchange(): void
    {
        $mock = new MockClient;
        $mock->addResponse($this->token('at_1', expiresIn: 3600));
        $mock->addResponse($this->json(200, []));
        $mock->addResponse($this->json(200, []));

        // The API requests suspend in the transport, so both calls are in flight together.
        $transport = new class($mock) implements ClientInterface {
            public function __construct(private MockClient $inner) {}

            public function sendRequest(RequestInterface $request): ResponseInterface
            {
                if (!str_ends_with($request->getUri()->getPath(), TokenManager::TOKEN_PATH)) {
                    \Fiber::suspend();
                }

                return $this->inner->sendRequest($request);
            }
        };

        $client = $this->client($transport);
        $fibers = [
            new \Fiber(static fn () => $client->misc->listSupportedCountries()),
            new \Fiber(static fn () => $client->misc->listSupportedCountries()),
        ];
        foreach ($fibers as $fiber) {
            $fiber->start();
        }
        foreach ($fibers as $fiber) {
            $this->assertTrue($fiber->isSuspended());
            $fiber->resume();
            $this->assertTrue($fiber->isTerminated());
        }

        $this->assertSame(1, $this->exchangeCount($mock));
        $this->assertCount(3, $mock->getRequests());
    }

    #[Test]
    public function testTokenNearExpiryIsExchangedAgain(): void
    {
        $mock = new MockClient;
        $mock->addResponse($this->token('at_1', expiresIn: 200));
        $mock->addResponse($this->json(200, []));
        $mock->addResponse($this->token('at_2', expiresIn: 200));
        $mock->addResponse($this->json(200, []));

        $client = $this->client($mock);
        $client->misc->listSupportedCountries();
        $client->misc->listSupportedCountries();

        $this->assertSame(2, $this->exchangeCount($mock));
        $this->assertSame('Bearer at_2', $mock->getRequests()[3]->getHeaderLine('Authorization'));
    }

    #[Test]
    public function testValidTokenIsReused(): void
    {
        $mock = new MockClient;
        $mock->addResponse($this->token('at_1', expiresIn: 3600));
        $mock->addResponse($this->json(200, []));
        $mock->addResponse($this->json(200, []));

        $client = $this->client($mock);
        $client->misc->listSupportedCountries();
        $client->misc->listSupportedCountries();

        $this->assertSame(1, $this->exchangeCount($mock));
        $this->assertSame('Bearer at_1', $mock->getRequests()[2]->getHeaderLine('Authorization'));
    }

    #[Test]
    public function testApi401ExchangesAgainAndRetriesOnce(): void
    {
        $mock = new MockClient;
        $mock->addResponse($this->token('at_1', expiresIn: 3600));
        $mock->addResponse($this->json(401, ['code' => 'UNAUTHORIZED']));
        $mock->addResponse($this->token('at_2', expiresIn: 3600));
        $mock->addResponse($this->json(200, []));

        $client = $this->client($mock);
        $client->misc->listSupportedCountries();

        $requests = $mock->getRequests();
        $this->assertCount(4, $requests);
        $this->assertSame(2, $this->exchangeCount($mock));
        $this->assertSame('Bearer at_2', $requests[3]->getHeaderLine('Authorization'));
    }

    #[Test]
    public function testSecondApi401Surfaces(): void
    {
        $mock = new MockClient;
        $mock->addResponse($this->token('at_1', expiresIn: 3600));
        $mock->addResponse($this->json(401, ['code' => 'UNAUTHORIZED']));
        $mock->addResponse($this->token('at_2', expiresIn: 3600));
        $mock->addResponse($this->json(401, ['code' => 'UNAUTHORIZED']));

        $client = $this->client($mock);

        try {
            $client->misc->listSupportedCountries();
            $this->fail('Expected an AuthenticationException.');
        } catch (AuthenticationException $e) {
            $this->assertSame(401, $e->status);
        }

        $this->assertCount(4, $mock->getRequests());
        $this->assertSame(2, $this->exchangeCount($mock));
    }

    #[Test]
    public function testBearerTokenAndWorkloadIdentityTogetherIsAnError(): void
    {
        $this->expectException(WorkloadIdentityException::class);

        new Client(
            bearerToken: 'My Bearer Token',
            baseUrl: 'http://localhost',
            workloadIdentity: new WorkloadIdentity(Providers::static(self::SUBJECT_TOKEN), identityProviderId: 'wip_test'),
        );
    }

    #[Test]
    public function testExchange403IsPermissionDenied(): void
    {
        $mock = new MockClient;
        $mock->addResponse($this->json(403, ['error' => 'invalid_grant', 'error_description' => 'The subject token is not trusted.']));

        // The default retry policy is on: the client must not retry a 4xx exchange response.
        $client = new Client(
            baseUrl: 'http://localhost',
            requestOptions: ['transporter' => $mock],
            workloadIdentity: new WorkloadIdentity(Providers::static(self::SUBJECT_TOKEN), identityProviderId: 'wip_test'),
        );

        try {
            $client->misc->listSupportedCountries();
            $this->fail('Expected a PermissionDeniedException.');
        } catch (PermissionDeniedException $e) {
            $this->assertSame(403, $e->status);
            $this->assertStringContainsString('invalid_grant', $e->getMessage());
            $this->assertStringContainsString('The subject token is not trusted.', $e->getMessage());
        }

        $this->assertCount(1, $mock->getRequests());
    }

    #[Test]
    public function testRevokeSendsBearerAndClearsCache(): void
    {
        $mock = new MockClient;
        $mock->addResponse($this->token('at_1', expiresIn: 3600));
        $mock->addResponse($this->json(200, []));
        $mock->addResponse($this->empty(204));
        $mock->addResponse($this->token('at_2', expiresIn: 3600));
        $mock->addResponse($this->json(200, []));

        $client = $this->client($mock);
        $client->misc->listSupportedCountries();

        $this->assertNotNull($client->workloadIdentity);
        $client->workloadIdentity->revoke();

        $revoke = $mock->getRequests()[2];
        $this->assertSame('POST', $revoke->getMethod());
        $this->assertSame('/'.TokenManager::REVOKE_PATH, $revoke->getUri()->getPath());
        $this->assertSame('Bearer at_1', $revoke->getHeaderLine('Authorization'));

        // A second revoke without a cached token sends nothing.
        $client->workloadIdentity->revoke();
        $this->assertCount(3, $mock->getRequests());

        $client->misc->listSupportedCountries();
        $this->assertSame(2, $this->exchangeCount($mock));
        $this->assertSame('Bearer at_2', $mock->getRequests()[4]->getHeaderLine('Authorization'));
    }

    #[Test]
    public function testEnvironmentSelectsWorkloadIdentity(): void
    {
        $file = tempnam(sys_get_temp_dir(), 'wif');
        $this->assertNotFalse($file);
        file_put_contents($file, self::SUBJECT_TOKEN."\n");

        $env = [
            'DODO_PAYMENTS_API_KEY' => '',
            WorkloadIdentity::IDENTITY_PROVIDER_ID_ENV => 'wip_env',
            Providers::TOKEN_FILE_ENV => $file,
            'ACTIONS_ID_TOKEN_REQUEST_URL' => '',
            'TFC_WORKLOAD_IDENTITY_TOKEN' => '',
            'TFC_WORKLOAD_IDENTITY_TOKEN_DODO' => '',
        ];
        $saved = [];
        foreach ($env as $name => $value) {
            $saved[$name] = $_ENV[$name] ?? null;
            $_ENV[$name] = $value;
        }

        try {
            $mock = new MockClient;
            $mock->addResponse($this->token('at_1', expiresIn: 3600));
            $mock->addResponse($this->json(200, []));

            $client = new Client(baseUrl: 'http://localhost', requestOptions: ['transporter' => $mock]);
            $client->misc->listSupportedCountries();

            $exchange = json_decode((string) $mock->getRequests()[0]->getBody(), associative: true);
            $this->assertIsArray($exchange);
            $this->assertSame(self::SUBJECT_TOKEN, $exchange['subject_token'] ?? null);
            $this->assertSame('wip_env', $exchange['identity_provider_id'] ?? null);
        } finally {
            foreach ($saved as $name => $value) {
                if (null === $value) {
                    unset($_ENV[$name]);
                } else {
                    $_ENV[$name] = $value;
                }
            }
            unlink($file);
        }
    }

    private function client(ClientInterface $transporter): Client
    {
        return new Client(
            baseUrl: 'http://localhost',
            requestOptions: ['transporter' => $transporter, 'maxRetries' => 0],
            workloadIdentity: new WorkloadIdentity(Providers::static(self::SUBJECT_TOKEN), identityProviderId: 'wip_test'),
        );
    }

    private function exchangeCount(MockClient $mock): int
    {
        return count(array_filter(
            $mock->getRequests(),
            static fn (RequestInterface $r): bool => '/'.TokenManager::TOKEN_PATH === $r->getUri()->getPath(),
        ));
    }

    private function token(string $accessToken, int $expiresIn): ResponseInterface
    {
        return $this->json(200, [
            'access_token' => $accessToken,
            'issued_token_type' => 'urn:ietf:params:oauth:token-type:access_token',
            'token_type' => 'Bearer',
            'expires_in' => $expiresIn,
            'scope' => 'payments:read',
        ]);
    }

    private function json(int $status, mixed $body): ResponseInterface
    {
        return Psr17FactoryDiscovery::findResponseFactory()
            ->createResponse($status)
            ->withHeader('Content-Type', 'application/json')
            ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(json_encode($body, flags: Util::JSON_ENCODE_FLAGS) ?: ''))
        ;
    }

    private function empty(int $status): ResponseInterface
    {
        return Psr17FactoryDiscovery::findResponseFactory()->createResponse($status);
    }
}
