<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\WebhookException;
use Dodopayments\Core\Util;
use Dodopayments\CursorPagePagination;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\Webhooks\WebhookDetails;
use Dodopayments\Webhooks\WebhookGetSecretResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use StandardWebhooks\Webhook;

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

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(bearerToken: 'My Bearer Token', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        $result = $this->client->webhooks->create(url: 'url');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookDetails::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->webhooks->create(
            url: 'url',
            description: 'description',
            disabled: true,
            filterTypes: [WebhookEventType::PAYMENT_SUCCEEDED],
            headers: ['foo' => 'string'],
            idempotencyKey: 'idempotency_key',
            metadata: ['foo' => 'string'],
            rateLimit: 0,
        );

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
        $result = $this->client->webhooks->update('webhook_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookDetails::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->webhooks->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorPagePagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(WebhookDetails::class, $item);
        }
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

    #[Test]
    public function testUnsafeUnwrap(): void
    {
        $payload = '{"business_id":"business_id","data":{"abandoned_at":"2019-12-27T18:11:19.117Z","abandonment_reason":"payment_failed","customer_id":"customer_id","payment_id":"payment_id","status":"abandoned","recovered_payment_id":"recovered_payment_id"},"timestamp":"2019-12-27T18:11:19.117Z","type":"abandoned_checkout.detected"}';
        $this->client->webhooks->unsafeUnwrap($payload);
        // unwrap successful if not error thrown, increment assertion count to avoid risky test warning
        $this->addToAssertionCount(1);
    }

    #[Test]
    public function testUnsafeUnwrapBadJson(): void
    {
        $this->expectException(WebhookException::class);

        $badPayload = 'not a json string';
        $this->client->webhooks->unsafeUnwrap($badPayload);
    }

    #[Test]
    public function testUnwrap(): void
    {
        $payload = '{"business_id":"business_id","data":{"abandoned_at":"2019-12-27T18:11:19.117Z","abandonment_reason":"payment_failed","customer_id":"customer_id","payment_id":"payment_id","status":"abandoned","recovered_payment_id":"recovered_payment_id"},"timestamp":"2019-12-27T18:11:19.117Z","type":"abandoned_checkout.detected"}';
        $this->client->webhooks->unwrap($payload);
        // unwrap successful if not error thrown, increment assertion count to avoid risky test warning
        $this->addToAssertionCount(1);
    }

    #[Test]
    public function testUnwrapBadJson(): void
    {
        $this->expectException(WebhookException::class);

        $badPayload = 'not a json string';
        $this->client->webhooks->unwrap($badPayload);
    }

    #[Test]
    public function testUnwrapWithVerification(): void
    {
        $payload = '{"business_id":"business_id","data":{"abandoned_at":"2019-12-27T18:11:19.117Z","abandonment_reason":"payment_failed","customer_id":"customer_id","payment_id":"payment_id","status":"abandoned","recovered_payment_id":"recovered_payment_id"},"timestamp":"2019-12-27T18:11:19.117Z","type":"abandoned_checkout.detected"}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $this->client->webhooks->unwrap($payload, $headers, $secret);
        // unwrap successful if not error thrown, increment assertion count to avoid risky test warning
        $this->addToAssertionCount(1);
    }

    #[Test]
    public function testUnwrapWrongKey(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"business_id":"business_id","data":{"abandoned_at":"2019-12-27T18:11:19.117Z","abandonment_reason":"payment_failed","customer_id":"customer_id","payment_id":"payment_id","status":"abandoned","recovered_payment_id":"recovered_payment_id"},"timestamp":"2019-12-27T18:11:19.117Z","type":"abandoned_checkout.detected"}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $wrongKey = 'whsec_aaaaaaaaaa';
        $this->client->webhooks->unwrap($payload, $headers, $wrongKey);
    }

    #[Test]
    public function testUnwrapBadSignature(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"business_id":"business_id","data":{"abandoned_at":"2019-12-27T18:11:19.117Z","abandonment_reason":"payment_failed","customer_id":"customer_id","payment_id":"payment_id","status":"abandoned","recovered_payment_id":"recovered_payment_id"},"timestamp":"2019-12-27T18:11:19.117Z","type":"abandoned_checkout.detected"}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $badSig = $webhook->sign($messageId, $timestamp, 'some other payload');

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$badSig],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $this->client->webhooks->unwrap($payload, $headers, $secret);
    }

    #[Test]
    public function testUnwrapOldTimestamp(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"business_id":"business_id","data":{"abandoned_at":"2019-12-27T18:11:19.117Z","abandonment_reason":"payment_failed","customer_id":"customer_id","payment_id":"payment_id","status":"abandoned","recovered_payment_id":"recovered_payment_id"},"timestamp":"2019-12-27T18:11:19.117Z","type":"abandoned_checkout.detected"}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => [$messageId],
            'webhook-timestamp' => ['5'],
        ];
        $this->client->webhooks->unwrap($payload, $headers, $secret);
    }

    #[Test]
    public function testUnwrapWrongMessageID(): void
    {
        $this->expectException(WebhookException::class);

        $payload = '{"business_id":"business_id","data":{"abandoned_at":"2019-12-27T18:11:19.117Z","abandonment_reason":"payment_failed","customer_id":"customer_id","payment_id":"payment_id","status":"abandoned","recovered_payment_id":"recovered_payment_id"},"timestamp":"2019-12-27T18:11:19.117Z","type":"abandoned_checkout.detected"}';
        $secret = 'whsec_c2VjcmV0Cg==';
        $webhook = new Webhook($secret);
        $messageId = '1';
        $timestamp = time();
        $signature = $webhook->sign($messageId, $timestamp, $payload);

        /** @var array<string, list<string>> $headers */
        $headers = [
            'webhook-signature' => [$signature],
            'webhook-id' => ['wrong'],
            'webhook-timestamp' => [(string) $timestamp],
        ];
        $this->client->webhooks->unwrap($payload, $headers, $secret);
    }
}
