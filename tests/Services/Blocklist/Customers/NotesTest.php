<?php

namespace Tests\Services\Blocklist\Customers;

use Dodopayments\Blocklist\Customers\Notes\BlockedCustomerNote;
use Dodopayments\Client;
use Dodopayments\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class NotesTest extends TestCase
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
        $result = $this->client->blocklist->customers->notes->create(
            'entry_id',
            note: 'note'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BlockedCustomerNote::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->blocklist->customers->notes->create(
            'entry_id',
            note: 'note'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BlockedCustomerNote::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->blocklist->customers->notes->update(
            'note_id',
            entryID: 'entry_id',
            note: 'note'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BlockedCustomerNote::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $result = $this->client->blocklist->customers->notes->update(
            'note_id',
            entryID: 'entry_id',
            note: 'note'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BlockedCustomerNote::class, $result);
    }
}
