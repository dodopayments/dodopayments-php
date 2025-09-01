<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\BillingAddress;
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
            productPrice: 0
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieveUsageHistory(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $result = $this->client->subscriptions->retrieveUsageHistory(
            'subscription_id'
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
