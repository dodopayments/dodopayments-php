<?php

namespace Tests\Resources;

use Dodopayments\Client;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\Webhooks\WebhookCreateParams;
use Dodopayments\Webhooks\WebhookListParams;
use Dodopayments\Webhooks\WebhookUpdateParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class WebhooksTest extends TestCase
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
    public function testCreate(): void
    {
        $params = WebhookCreateParams::from(url: 'url');
        $result = $this->client->webhooks->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $params = WebhookCreateParams::from(
            url: 'url',
            description: 'description',
            disabled: true,
            filterTypes: [WebhookEventType::PAYMENT_SUCCEEDED],
            headers: ['foo' => 'string'],
            idempotencyKey: 'idempotency_key',
            metadata: ['foo' => 'string'],
            rateLimit: 0,
        );
        $result = $this->client->webhooks->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->webhooks->retrieve('webhook_id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdate(): void
    {
        $params = (new WebhookUpdateParams);
        $result = $this->client->webhooks->update('webhook_id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $params = (new WebhookListParams);
        $result = $this->client->webhooks->list($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->webhooks->delete('webhook_id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieveSecret(): void
    {
        $result = $this->client->webhooks->retrieveSecret('webhook_id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
