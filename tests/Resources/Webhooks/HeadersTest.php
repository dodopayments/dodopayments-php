<?php

namespace Tests\Resources\Webhooks;

use DodoPayments\Client;
use DodoPayments\Webhooks\Headers\HeaderUpdateParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class HeadersTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(bearerToken: 'My Bearer Token', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->webhooks->headers->retrieve('webhook_id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdate(): void
    {
        $params = HeaderUpdateParams::from(headers: ['foo' => 'string']);
        $result = $this->client->webhooks->headers->update('webhook_id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $params = HeaderUpdateParams::from(headers: ['foo' => 'string']);
        $result = $this->client->webhooks->headers->update('webhook_id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
