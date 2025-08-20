<?php

namespace Tests\Resources;

use Dodopayments\Client;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\Subscriptions\AttachAddon;
use Dodopayments\Subscriptions\SubscriptionCreateParams\OnDemand;
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
        $result = $this->client->subscriptions->create(
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

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->subscriptions->create(
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
        $result = $this->client->subscriptions->update('subscription_id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $result = $this->client->subscriptions->list();

        $this->assertTrue(true); // @phpstan-ignore-line
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

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testChangePlanWithOptionalParams(): void
    {
        $result = $this->client->subscriptions->changePlan(
            'subscription_id',
            productID: 'product_id',
            prorationBillingMode: 'prorated_immediately',
            quantity: 0,
            addons: [AttachAddon::with(addonID: 'addon_id', quantity: 0)],
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCharge(): void
    {
        $result = $this->client->subscriptions->charge(
            'subscription_id',
            productPrice: 0
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testChargeWithOptionalParams(): void
    {
        $result = $this->client->subscriptions->charge(
            'subscription_id',
            productPrice: 0,
            adaptiveCurrencyFeesInclusive: true,
            metadata: ['foo' => 'string'],
            productCurrency: Currency::AED,
            productDescription: 'product_description',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
