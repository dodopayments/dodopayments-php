<?php

namespace Tests\Services;

use Dodopayments\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class SubscriptionsTest extends TestCase
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
        $result = $this->client->subscriptions->create([
            'billing' => [
                'city' => 'city',
                'country' => 'AF',
                'state' => 'state',
                'street' => 'street',
                'zipcode' => 'zipcode',
            ],
            'customer' => ['customer_id' => 'customer_id'],
            'product_id' => 'product_id',
            'quantity' => 0,
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->subscriptions->create([
            'billing' => [
                'city' => 'city',
                'country' => 'AF',
                'state' => 'state',
                'street' => 'street',
                'zipcode' => 'zipcode',
            ],
            'customer' => ['customer_id' => 'customer_id'],
            'product_id' => 'product_id',
            'quantity' => 0,
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->subscriptions->retrieve('subscription_id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->subscriptions->update('subscription_id', []);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $result = $this->client->subscriptions->list([]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testChangePlan(): void
    {
        $result = $this->client->subscriptions->changePlan(
            'subscription_id',
            [
                'product_id' => 'product_id',
                'proration_billing_mode' => 'prorated_immediately',
                'quantity' => 0,
            ],
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testChangePlanWithOptionalParams(): void
    {
        $result = $this->client->subscriptions->changePlan(
            'subscription_id',
            [
                'product_id' => 'product_id',
                'proration_billing_mode' => 'prorated_immediately',
                'quantity' => 0,
            ],
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testCharge(): void
    {
        $result = $this->client->subscriptions->charge(
            'subscription_id',
            ['product_price' => 0]
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testChargeWithOptionalParams(): void
    {
        $result = $this->client->subscriptions->charge(
            'subscription_id',
            ['product_price' => 0]
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRetrieveUsageHistory(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $result = $this->client->subscriptions->retrieveUsageHistory(
            'subscription_id',
            []
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testUpdatePaymentMethod(): void
    {
        $result = $this->client->subscriptions->updatePaymentMethod(
            'subscription_id',
            ['type' => 'existing', 'payment_method_id' => 'payment_method_id'],
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testUpdatePaymentMethodWithOptionalParams(): void
    {
        $result = $this->client->subscriptions->updatePaymentMethod(
            'subscription_id',
            ['type' => 'existing', 'payment_method_id' => 'payment_method_id'],
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
