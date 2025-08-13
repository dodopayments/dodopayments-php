<?php

namespace Tests\Resources;

use DodopaymentsClient\Client;
use DodopaymentsClient\Misc\CountryCode;
use DodopaymentsClient\Misc\Currency;
use DodopaymentsClient\Payments\AttachExistingCustomer;
use DodopaymentsClient\Payments\BillingAddress;
use DodopaymentsClient\Payments\PaymentMethodTypes;
use DodopaymentsClient\Subscriptions\AttachAddon;
use DodopaymentsClient\Subscriptions\SubscriptionChangePlanParams;
use DodopaymentsClient\Subscriptions\SubscriptionChargeParams;
use DodopaymentsClient\Subscriptions\SubscriptionCreateParams;
use DodopaymentsClient\Subscriptions\SubscriptionCreateParams\OnDemand;
use DodopaymentsClient\Subscriptions\SubscriptionListParams;
use DodopaymentsClient\Subscriptions\SubscriptionUpdateParams;
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
        $params = SubscriptionCreateParams::from(
            billing: BillingAddress::from(
                city: 'city',
                country: CountryCode::AF,
                state: 'state',
                street: 'street',
                zipcode: 'zipcode',
            ),
            customer: AttachExistingCustomer::from(customerID: 'customer_id'),
            productID: 'product_id',
            quantity: 0,
        );
        $result = $this->client->subscriptions->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $params = SubscriptionCreateParams::from(
            billing: BillingAddress::from(
                city: 'city',
                country: CountryCode::AF,
                state: 'state',
                street: 'street',
                zipcode: 'zipcode',
            ),
            customer: AttachExistingCustomer::from(customerID: 'customer_id'),
            productID: 'product_id',
            quantity: 0,
            addons: [AttachAddon::from(addonID: 'addon_id', quantity: 0)],
            allowedPaymentMethodTypes: [PaymentMethodTypes::CREDIT],
            billingCurrency: Currency::AED,
            discountCode: 'discount_code',
            metadata: ['foo' => 'string'],
            onDemand: OnDemand::from(mandateOnly: true)
                ->setAdaptiveCurrencyFeesInclusive(true)
                ->setProductCurrency(Currency::AED)
                ->setProductDescription('product_description')
                ->setProductPrice(0),
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
        $params = SubscriptionChangePlanParams::from(
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
        $params = SubscriptionChangePlanParams::from(
            productID: 'product_id',
            prorationBillingMode: 'prorated_immediately',
            quantity: 0,
            addons: [AttachAddon::from(addonID: 'addon_id', quantity: 0)],
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
        $params = SubscriptionChargeParams::from(productPrice: 0);
        $result = $this->client->subscriptions->charge('subscription_id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testChargeWithOptionalParams(): void
    {
        $params = SubscriptionChargeParams::from(
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
