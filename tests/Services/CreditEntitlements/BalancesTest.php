<?php

namespace Tests\Services\CreditEntitlements;

use Dodopayments\Client;
use Dodopayments\Core\Util;
use Dodopayments\CreditEntitlements\Balances\BalanceListGrantsResponse;
use Dodopayments\CreditEntitlements\Balances\BalanceNewLedgerEntryResponse;
use Dodopayments\CreditEntitlements\Balances\CreditLedgerEntry;
use Dodopayments\CreditEntitlements\Balances\CustomerCreditBalance;
use Dodopayments\CreditEntitlements\Balances\LedgerEntryType;
use Dodopayments\DefaultPageNumberPagination;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class BalancesTest extends TestCase
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
    public function testRetrieve(): void
    {
        $result = $this->client->creditEntitlements->balances->retrieve(
            'customer_id',
            creditEntitlementID: 'credit_entitlement_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CustomerCreditBalance::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->creditEntitlements->balances->retrieve(
            'customer_id',
            creditEntitlementID: 'credit_entitlement_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CustomerCreditBalance::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->creditEntitlements->balances->list(
            'credit_entitlement_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(CustomerCreditBalance::class, $item);
        }
    }

    #[Test]
    public function testCreateLedgerEntry(): void
    {
        $result = $this->client->creditEntitlements->balances->createLedgerEntry(
            'customer_id',
            creditEntitlementID: 'credit_entitlement_id',
            amount: 'amount',
            entryType: LedgerEntryType::CREDIT,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BalanceNewLedgerEntryResponse::class, $result);
    }

    #[Test]
    public function testCreateLedgerEntryWithOptionalParams(): void
    {
        $result = $this->client->creditEntitlements->balances->createLedgerEntry(
            'customer_id',
            creditEntitlementID: 'credit_entitlement_id',
            amount: 'amount',
            entryType: LedgerEntryType::CREDIT,
            expiresAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            idempotencyKey: 'idempotency_key',
            metadata: ['foo' => 'string'],
            reason: 'reason',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BalanceNewLedgerEntryResponse::class, $result);
    }

    #[Test]
    public function testListGrants(): void
    {
        $page = $this->client->creditEntitlements->balances->listGrants(
            'customer_id',
            creditEntitlementID: 'credit_entitlement_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(BalanceListGrantsResponse::class, $item);
        }
    }

    #[Test]
    public function testListGrantsWithOptionalParams(): void
    {
        $page = $this->client->creditEntitlements->balances->listGrants(
            'customer_id',
            creditEntitlementID: 'credit_entitlement_id',
            pageNumber: 0,
            pageSize: 0,
            status: 'active',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(BalanceListGrantsResponse::class, $item);
        }
    }

    #[Test]
    public function testListLedger(): void
    {
        $page = $this->client->creditEntitlements->balances->listLedger(
            'customer_id',
            creditEntitlementID: 'credit_entitlement_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(CreditLedgerEntry::class, $item);
        }
    }

    #[Test]
    public function testListLedgerWithOptionalParams(): void
    {
        $page = $this->client->creditEntitlements->balances->listLedger(
            'customer_id',
            creditEntitlementID: 'credit_entitlement_id',
            endDate: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            pageNumber: 0,
            pageSize: 0,
            startDate: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            transactionType: 'transaction_type',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(CreditLedgerEntry::class, $item);
        }
    }
}
