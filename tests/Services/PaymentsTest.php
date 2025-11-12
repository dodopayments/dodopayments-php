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
final class PaymentsTest extends TestCase
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
        $result = $this->client->payments->create([
            'billing' => [
                'city' => 'city',
                'country' => 'AF',
                'state' => 'state',
                'street' => 'street',
                'zipcode' => 'zipcode',
            ],
            'customer' => ['customer_id' => 'customer_id'],
            'product_cart' => [['product_id' => 'product_id', 'quantity' => 0]],
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->payments->create([
            'billing' => [
                'city' => 'city',
                'country' => 'AF',
                'state' => 'state',
                'street' => 'street',
                'zipcode' => 'zipcode',
            ],
            'customer' => ['customer_id' => 'customer_id'],
            'product_cart' => [
                ['product_id' => 'product_id', 'quantity' => 0, 'amount' => 0],
            ],
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->payments->retrieve('payment_id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $result = $this->client->payments->list([]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRetrieveLineItems(): void
    {
        $result = $this->client->payments->retrieveLineItems('payment_id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
