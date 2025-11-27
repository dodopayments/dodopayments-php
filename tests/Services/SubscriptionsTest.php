<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Subscriptions\Subscription;
use Dodopayments\Subscriptions\SubscriptionChargeResponse;
use Dodopayments\Subscriptions\SubscriptionNewResponse;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodResponse;
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

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SubscriptionNewResponse::class, $result);
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
            'addons' => [['addon_id' => 'addon_id', 'quantity' => 0]],
            'allowed_payment_method_types' => ['credit'],
            'billing_currency' => 'AED',
            'discount_code' => 'discount_code',
            'force_3ds' => true,
            'metadata' => ['foo' => 'string'],
            'on_demand' => [
                'mandate_only' => true,
                'adaptive_currency_fees_inclusive' => true,
                'product_currency' => 'AED',
                'product_description' => 'product_description',
                'product_price' => 0,
            ],
            'payment_link' => true,
            'return_url' => 'return_url',
            'show_saved_payment_methods' => true,
            'tax_id' => 'tax_id',
            'trial_period_days' => 0,
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SubscriptionNewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->subscriptions->retrieve('subscription_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Subscription::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->subscriptions->update('subscription_id', []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Subscription::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $result = $this->client->subscriptions->list([]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $result);
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

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
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
                'addons' => [['addon_id' => 'addon_id', 'quantity' => 0]],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCharge(): void
    {
        $result = $this->client->subscriptions->charge(
            'subscription_id',
            ['product_price' => 0]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SubscriptionChargeResponse::class, $result);
    }

    #[Test]
    public function testChargeWithOptionalParams(): void
    {
        $result = $this->client->subscriptions->charge(
            'subscription_id',
            [
                'product_price' => 0,
                'adaptive_currency_fees_inclusive' => true,
                'customer_balance_config' => [
                    'allow_customer_credits_purchase' => true,
                    'allow_customer_credits_usage' => true,
                ],
                'metadata' => ['foo' => 'string'],
                'product_currency' => 'AED',
                'product_description' => 'product_description',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SubscriptionChargeResponse::class, $result);
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

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $result);
    }

    #[Test]
    public function testUpdatePaymentMethod(): void
    {
        $result = $this->client->subscriptions->updatePaymentMethod(
            'subscription_id',
            ['STAINLESS_FIXME_type' => 'new']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            SubscriptionUpdatePaymentMethodResponse::class,
            $result
        );
    }

    #[Test]
    public function testUpdatePaymentMethodWithOptionalParams(): void
    {
        $result = $this->client->subscriptions->updatePaymentMethod(
            'subscription_id',
            [
                'STAINLESS_FIXME_type' => 'new',
                'STAINLESS_FIXME_return_url' => 'return_url',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            SubscriptionUpdatePaymentMethodResponse::class,
            $result
        );
    }
}
