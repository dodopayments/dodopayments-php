<?php

namespace Tests\Resources;

use Dodopayments\Client;
use Dodopayments\Customers\CustomerCreateParams;
use Dodopayments\Customers\CustomerListParams;
use Dodopayments\Customers\CustomerUpdateParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class CustomersTest extends TestCase
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
        $params = CustomerCreateParams::with(email: 'email', name: 'name');
        $result = $this->client->customers->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $params = CustomerCreateParams::with(
            email: 'email',
            name: 'name',
            phoneNumber: 'phone_number'
        );
        $result = $this->client->customers->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->customers->retrieve('customer_id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdate(): void
    {
        $params = (new CustomerUpdateParams);
        $result = $this->client->customers->update('customer_id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $params = (new CustomerListParams);
        $result = $this->client->customers->list($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
