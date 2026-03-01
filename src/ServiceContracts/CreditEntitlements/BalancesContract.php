<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\CreditEntitlements;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\CreditEntitlements\Balances\BalanceListGrantsParams\Status;
use Dodopayments\CreditEntitlements\Balances\BalanceListGrantsResponse;
use Dodopayments\CreditEntitlements\Balances\BalanceNewLedgerEntryResponse;
use Dodopayments\CreditEntitlements\Balances\CreditLedgerEntry;
use Dodopayments\CreditEntitlements\Balances\CustomerCreditBalance;
use Dodopayments\CreditEntitlements\Balances\LedgerEntryType;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface BalancesContract
{
    /**
     * @api
     *
     * @param string $customerID Customer ID
     * @param string $creditEntitlementID Credit Entitlement ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $customerID,
        string $creditEntitlementID,
        RequestOptions|array|null $requestOptions = null,
    ): CustomerCreditBalance;

    /**
     * @api
     *
     * @param string $creditEntitlementID Credit Entitlement ID
     * @param string $customerID Filter by specific customer ID
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<CustomerCreditBalance>
     *
     * @throws APIException
     */
    public function list(
        string $creditEntitlementID,
        ?string $customerID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param string $customerID Path param: Customer ID
     * @param string $creditEntitlementID Path param: Credit Entitlement ID
     * @param string $amount Body param: Amount to credit or debit
     * @param LedgerEntryType|value-of<LedgerEntryType> $entryType Body param: Entry type: credit or debit
     * @param \DateTimeInterface|null $expiresAt Body param: Expiration for credited amount (only for credit type)
     * @param string|null $idempotencyKey Body param: Idempotency key to prevent duplicate entries
     * @param array<string,string>|null $metadata Body param: Optional metadata (max 50 key-value pairs, key max 40 chars, value max 500 chars)
     * @param string|null $reason Body param: Human-readable reason for the entry
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createLedgerEntry(
        string $customerID,
        string $creditEntitlementID,
        string $amount,
        LedgerEntryType|string $entryType,
        ?\DateTimeInterface $expiresAt = null,
        ?string $idempotencyKey = null,
        ?array $metadata = null,
        ?string $reason = null,
        RequestOptions|array|null $requestOptions = null,
    ): BalanceNewLedgerEntryResponse;

    /**
     * @api
     *
     * @param string $customerID Path param: Customer ID
     * @param string $creditEntitlementID Path param: Credit Entitlement ID
     * @param int $pageNumber Query param: Page number default is 0
     * @param int $pageSize Query param: Page size default is 10 max is 100
     * @param Status|value-of<Status> $status Query param: Filter by grant status: active, expired, depleted
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<BalanceListGrantsResponse>
     *
     * @throws APIException
     */
    public function listGrants(
        string $customerID,
        string $creditEntitlementID,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param string $customerID Path param: Customer ID
     * @param string $creditEntitlementID Path param: Credit Entitlement ID
     * @param \DateTimeInterface $endDate Query param: Filter by end date
     * @param int $pageNumber Query param: Page number default is 0
     * @param int $pageSize Query param: Page size default is 10 max is 100
     * @param \DateTimeInterface $startDate Query param: Filter by start date
     * @param string $transactionType Query param: Filter by transaction type (snake_case: credit_added, credit_deducted, credit_expired, etc.)
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<CreditLedgerEntry>
     *
     * @throws APIException
     */
    public function listLedger(
        string $customerID,
        string $creditEntitlementID,
        ?\DateTimeInterface $endDate = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?\DateTimeInterface $startDate = null,
        ?string $transactionType = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;
}
