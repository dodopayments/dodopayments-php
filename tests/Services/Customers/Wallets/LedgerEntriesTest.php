<?php

namespace Tests\Services\Customers\Wallets;

use Dodopayments\Client;
use Dodopayments\Customers\Wallets\CustomerWallet;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class LedgerEntriesTest extends TestCase
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
        $result = $this->client->customers->wallets->ledgerEntries->create(
            'customer_id',
            ['amount' => 0, 'currency' => Currency::AED, 'entry_type' => 'credit'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CustomerWallet::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->customers->wallets->ledgerEntries->create(
            'customer_id',
            [
                'amount' => 0,
                'currency' => Currency::AED,
                'entry_type' => 'credit',
                'idempotency_key' => 'idempotency_key',
                'reason' => 'reason',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CustomerWallet::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->customers->wallets->ledgerEntries->list(
            'customer_id',
            []
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $result);
    }
}
