<?php

namespace Tests\Services\Blocklist;

use Dodopayments\Blocklist\Customers\BlockedCustomer;
use Dodopayments\Blocklist\Customers\BlockedCustomerSource;
use Dodopayments\Client;
use Dodopayments\Core\Util;
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

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(bearerToken: 'My Bearer Token', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        $result = $this->client->blocklist->customers->create(
            customerID: 'customer_id',
            email: 'email'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BlockedCustomer::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->blocklist->customers->create(
            customerID: 'customer_id',
            reason: 'reason',
            source: BlockedCustomerSource::BLOCKLIST_PAGE,
            email: 'email',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BlockedCustomer::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->blocklist->customers->retrieve('entry_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BlockedCustomer::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->blocklist->customers->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(BlockedCustomer::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->blocklist->customers->delete('entry_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
