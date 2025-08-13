<?php

namespace Tests\Resources\Customers;

use Dodopayments\Client;
use Dodopayments\Customers\CustomerPortal\CustomerPortalCreateParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class CustomerPortalTest extends TestCase
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
        $params = (new CustomerPortalCreateParams);
        $result = $this
            ->client
            ->customers
            ->customerPortal
            ->create('customer_id', $params)
        ;

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
