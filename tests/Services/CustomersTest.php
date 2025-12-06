<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\Customers\Customer;
use Dodopayments\Customers\CustomerGetPaymentMethodsResponse;
use Dodopayments\DefaultPageNumberPagination;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

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
        $result = $this->client->customers->create([
            'email' => 'email', 'name' => 'name',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Customer::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->customers->create([
            'email' => 'email',
            'name' => 'name',
            'metadata' => ['foo' => 'string'],
            'phone_number' => 'phone_number',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Customer::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->customers->retrieve('customer_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Customer::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->customers->update('customer_id', []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Customer::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->customers->list([]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $result);
    }

    #[Test]
    public function testRetrievePaymentMethods(): void
    {
        $result = $this->client->customers->retrievePaymentMethods('customer_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CustomerGetPaymentMethodsResponse::class, $result);
    }
}
