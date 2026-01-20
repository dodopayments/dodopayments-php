<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\Subscriptions\Subscription;
use Dodopayments\Subscriptions\SubscriptionChargeResponse;
use Dodopayments\Subscriptions\SubscriptionGetUsageHistoryResponse;
use Dodopayments\Subscriptions\SubscriptionListResponse;
use Dodopayments\Subscriptions\SubscriptionNewResponse;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

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
        $result = $this->client->subscriptions->create(
            billing: ['country' => CountryCode::AF],
            customer: ['customerID' => 'customer_id'],
            productID: 'product_id',
            quantity: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SubscriptionNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->subscriptions->create(
            billing: [
                'country' => CountryCode::AF,
                'city' => 'city',
                'state' => 'state',
                'street' => 'street',
                'zipcode' => 'zipcode',
            ],
            customer: ['customerID' => 'customer_id'],
            productID: 'product_id',
            quantity: 0,
            addons: [['addonID' => 'addon_id', 'quantity' => 0]],
            allowedPaymentMethodTypes: [PaymentMethodTypes::CREDIT],
            billingCurrency: Currency::AED,
            discountCode: 'discount_code',
            force3DS: true,
            metadata: ['foo' => 'string'],
            onDemand: [
                'mandateOnly' => true,
                'adaptiveCurrencyFeesInclusive' => true,
                'productCurrency' => Currency::AED,
                'productDescription' => 'product_description',
                'productPrice' => 0,
            ],
            oneTimeProductCart: [
                ['productID' => 'product_id', 'quantity' => 0, 'amount' => 0],
            ],
            paymentLink: true,
            paymentMethodID: 'payment_method_id',
            redirectImmediately: true,
            returnURL: 'return_url',
            shortLink: true,
            showSavedPaymentMethods: true,
            taxID: 'tax_id',
            trialPeriodDays: 0,
        );

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
        $result = $this->client->subscriptions->update('subscription_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Subscription::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->subscriptions->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(SubscriptionListResponse::class, $item);
        }
    }

    #[Test]
    public function testChangePlan(): void
    {
        $result = $this->client->subscriptions->changePlan(
            'subscription_id',
            productID: 'product_id',
            prorationBillingMode: 'prorated_immediately',
            quantity: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testChangePlanWithOptionalParams(): void
    {
        $result = $this->client->subscriptions->changePlan(
            'subscription_id',
            productID: 'product_id',
            prorationBillingMode: 'prorated_immediately',
            quantity: 0,
            addons: [['addonID' => 'addon_id', 'quantity' => 0]],
            metadata: ['foo' => 'string'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCharge(): void
    {
        $result = $this->client->subscriptions->charge(
            'subscription_id',
            productPrice: 0
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SubscriptionChargeResponse::class, $result);
    }

    #[Test]
    public function testChargeWithOptionalParams(): void
    {
        $result = $this->client->subscriptions->charge(
            'subscription_id',
            productPrice: 0,
            adaptiveCurrencyFeesInclusive: true,
            customerBalanceConfig: [
                'allowCustomerCreditsPurchase' => true,
                'allowCustomerCreditsUsage' => true,
            ],
            metadata: ['foo' => 'string'],
            productCurrency: Currency::AED,
            productDescription: 'product_description',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SubscriptionChargeResponse::class, $result);
    }

    #[Test]
    public function testPreviewChangePlan(): void
    {
        $result = $this->client->subscriptions->previewChangePlan(
            'subscription_id',
            productID: 'product_id',
            prorationBillingMode: 'prorated_immediately',
            quantity: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            SubscriptionPreviewChangePlanResponse::class,
            $result
        );
    }

    #[Test]
    public function testPreviewChangePlanWithOptionalParams(): void
    {
        $result = $this->client->subscriptions->previewChangePlan(
            'subscription_id',
            productID: 'product_id',
            prorationBillingMode: 'prorated_immediately',
            quantity: 0,
            addons: [['addonID' => 'addon_id', 'quantity' => 0]],
            metadata: ['foo' => 'string'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            SubscriptionPreviewChangePlanResponse::class,
            $result
        );
    }

    #[Test]
    public function testRetrieveUsageHistory(): void
    {
        $page = $this->client->subscriptions->retrieveUsageHistory(
            'subscription_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(
                SubscriptionGetUsageHistoryResponse::class,
                $item
            );
        }
    }

    #[Test]
    public function testUpdatePaymentMethod(): void
    {
        $result = $this->client->subscriptions->updatePaymentMethod(
            'subscription_id',
            type: 'existing',
            paymentMethodID: 'payment_method_id'
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
            type: 'existing',
            returnURL: 'return_url',
            paymentMethodID: 'payment_method_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            SubscriptionUpdatePaymentMethodResponse::class,
            $result
        );
    }
}
