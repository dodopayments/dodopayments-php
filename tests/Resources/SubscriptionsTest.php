<?php

namespace Tests\Resources;

use Dodopayments\Client;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\Subscriptions\AttachAddon;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams;
use Dodopayments\Subscriptions\SubscriptionChargeParams;
use Dodopayments\Subscriptions\SubscriptionCreateParams;
use Dodopayments\Subscriptions\SubscriptionCreateParams\OnDemand;
use Dodopayments\Subscriptions\SubscriptionListParams;
use Dodopayments\Subscriptions\SubscriptionUpdateParams;
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
        $params = SubscriptionCreateParams::with(
            billing: BillingAddress::with(
                city: 'city',
                country: CountryCode::AF,
                state: 'state',
                street: 'street',
                zipcode: 'zipcode',
            ),
            customer: AttachExistingCustomer::with(customerID: 'customer_id'),
            productID: 'product_id',
            quantity: 0,
        );
        $result = $this->client->subscriptions->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $params = SubscriptionCreateParams::with(
            billing: BillingAddress::with(
                city: 'city',
                country: CountryCode::AF,
                state: 'state',
                street: 'street',
                zipcode: 'zipcode',
            ),
            customer: AttachExistingCustomer::with(customerID: 'customer_id'),
            productID: 'product_id',
            quantity: 0,
            addons: [AttachAddon::with(addonID: 'addon_id', quantity: 0)],
            allowedPaymentMethodTypes: [PaymentMethodTypes::CREDIT],
            billingCurrency: Currency::AED,
            discountCode: 'discount_code',
            metadata: ['foo' => 'string'],
            onDemand: OnDemand::with(mandateOnly: true)
                ->withAdaptiveCurrencyFeesInclusive(true)
                ->withProductCurrency(Currency::AED)
                ->withProductDescription('product_description')
                ->withProductPrice(0),
            paymentLink: true,
            returnURL: 'return_url',
            showSavedPaymentMethods: true,
            taxID: 'tax_id',
            trialPeriodDays: 0,
        );
        $result = $this->client->subscriptions->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->subscriptions->retrieve('subscription_id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdate(): void
    {
        $params = (new SubscriptionUpdateParams);
        $result = $this->client->subscriptions->update('subscription_id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $params = (new SubscriptionListParams);
        $result = $this->client->subscriptions->list($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testChangePlan(): void
    {
        $params = SubscriptionChangePlanParams::with(
            productID: 'product_id',
            prorationBillingMode: 'prorated_immediately',
            quantity: 0,
        );
        $result = $this
            ->client
            ->subscriptions
            ->changePlan('subscription_id', $params)
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testChangePlanWithOptionalParams(): void
    {
        $params = SubscriptionChangePlanParams::with(
            productID: 'product_id',
            prorationBillingMode: 'prorated_immediately',
            quantity: 0,
            addons: [AttachAddon::with(addonID: 'addon_id', quantity: 0)],
        );
        $result = $this
            ->client
            ->subscriptions
            ->changePlan('subscription_id', $params)
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCharge(): void
    {
        $params = SubscriptionChargeParams::with(productPrice: 0);
        $result = $this->client->subscriptions->charge('subscription_id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testChargeWithOptionalParams(): void
    {
        $params = SubscriptionChargeParams::with(
            productPrice: 0,
            adaptiveCurrencyFeesInclusive: true,
            metadata: ['foo' => 'string'],
            productCurrency: Currency::AED,
            productDescription: 'product_description',
        );
        $result = $this->client->subscriptions->charge('subscription_id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
