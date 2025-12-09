<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\CursorPagePagination;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\Webhooks\WebhookDetails;
use Dodopayments\Webhooks\WebhookGetSecretResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

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
        $result = $this->client->webhooks->create(['url' => 'url']);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookDetails::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->webhooks->create([
            'url' => 'url',
            'description' => 'description',
            'disabled' => true,
            'filterTypes' => [WebhookEventType::PAYMENT_SUCCEEDED],
            'headers' => ['foo' => 'string'],
            'idempotencyKey' => 'idempotency_key',
            'metadata' => ['foo' => 'string'],
            'rateLimit' => 0,
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookDetails::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->webhooks->retrieve('webhook_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookDetails::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->webhooks->update('webhook_id', []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookDetails::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->webhooks->list([]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorPagePagination::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->webhooks->delete('webhook_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testRetrieveSecret(): void
    {
        $result = $this->client->webhooks->retrieveSecret('webhook_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookGetSecretResponse::class, $result);
    }
}
