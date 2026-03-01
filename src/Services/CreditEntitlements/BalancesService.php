<?php

declare(strict_types=1);

namespace Dodopayments\Services\CreditEntitlements;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\CreditEntitlements\Balances\BalanceListGrantsParams\Status;
use Dodopayments\CreditEntitlements\Balances\BalanceListGrantsResponse;
use Dodopayments\CreditEntitlements\Balances\BalanceNewLedgerEntryResponse;
use Dodopayments\CreditEntitlements\Balances\CreditLedgerEntry;
use Dodopayments\CreditEntitlements\Balances\CustomerCreditBalance;
use Dodopayments\CreditEntitlements\Balances\LedgerEntryType;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\CreditEntitlements\BalancesContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class BalancesService implements BalancesContract
{
    /**
     * @api
     */
    public BalancesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BalancesRawService($client);
    }

    /**
     * @api
     *
     * Returns the credit balance details for a specific customer and credit entitlement.
     *
     * # Authentication
     * Requires an API key with `Viewer` role or higher.
     *
     * # Path Parameters
     * - `credit_entitlement_id` - The unique identifier of the credit entitlement
     * - `customer_id` - The unique identifier of the customer
     *
     * # Responses
     * - `200 OK` - Returns the customer's balance
     * - `404 Not Found` - Credit entitlement or customer balance not found
     * - `500 Internal Server Error` - Database or server error
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
    ): CustomerCreditBalance {
        $params = Util::removeNulls(
            ['creditEntitlementID' => $creditEntitlementID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($customerID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns a paginated list of customer credit balances for the given credit entitlement.
     *
     * # Authentication
     * Requires an API key with `Viewer` role or higher.
     *
     * # Path Parameters
     * - `credit_entitlement_id` - The unique identifier of the credit entitlement
     *
     * # Query Parameters
     * - `page_size` - Number of items per page (default: 10, max: 100)
     * - `page_number` - Zero-based page number (default: 0)
     * - `customer_id` - Optional filter by specific customer
     *
     * # Responses
     * - `200 OK` - Returns list of customer balances
     * - `404 Not Found` - Credit entitlement not found
     * - `500 Internal Server Error` - Database or server error
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
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'customerID' => $customerID,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($creditEntitlementID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * For credit entries, a new grant is created. For debit entries, credits are
     * deducted from existing grants using FIFO (oldest first).
     *
     * # Authentication
     * Requires an API key with `Editor` role.
     *
     * # Path Parameters
     * - `credit_entitlement_id` - The unique identifier of the credit entitlement
     * - `customer_id` - The unique identifier of the customer
     *
     * # Request Body
     * - `entry_type` - "credit" or "debit"
     * - `amount` - Amount to credit or debit
     * - `reason` - Optional human-readable reason
     * - `expires_at` - Optional expiration for credited amount (only for credit type)
     * - `idempotency_key` - Optional key to prevent duplicate entries
     *
     * # Responses
     * - `201 Created` - Ledger entry created successfully
     * - `400 Bad Request` - Invalid request (e.g., debit with insufficient balance)
     * - `404 Not Found` - Credit entitlement or customer not found
     * - `409 Conflict` - Idempotency key already exists
     * - `500 Internal Server Error` - Database or server error
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
    ): BalanceNewLedgerEntryResponse {
        $params = Util::removeNulls(
            [
                'creditEntitlementID' => $creditEntitlementID,
                'amount' => $amount,
                'entryType' => $entryType,
                'expiresAt' => $expiresAt,
                'idempotencyKey' => $idempotencyKey,
                'metadata' => $metadata,
                'reason' => $reason,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createLedgerEntry($customerID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns a paginated list of credit grants with optional filtering by status.
     *
     * # Authentication
     * Requires an API key with `Viewer` role or higher.
     *
     * # Path Parameters
     * - `credit_entitlement_id` - The unique identifier of the credit entitlement
     * - `customer_id` - The unique identifier of the customer
     *
     * # Query Parameters
     * - `page_size` - Number of items per page (default: 10, max: 100)
     * - `page_number` - Zero-based page number (default: 0)
     * - `status` - Filter by status: active, expired, depleted
     *
     * # Responses
     * - `200 OK` - Returns list of grants
     * - `404 Not Found` - Credit entitlement not found
     * - `500 Internal Server Error` - Database or server error
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
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'creditEntitlementID' => $creditEntitlementID,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listGrants($customerID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns a paginated list of credit transaction history with optional filtering.
     *
     * # Authentication
     * Requires an API key with `Viewer` role or higher.
     *
     * # Path Parameters
     * - `credit_entitlement_id` - The unique identifier of the credit entitlement
     * - `customer_id` - The unique identifier of the customer
     *
     * # Query Parameters
     * - `page_size` - Number of items per page (default: 10, max: 100)
     * - `page_number` - Zero-based page number (default: 0)
     * - `transaction_type` - Filter by transaction type
     * - `start_date` - Filter entries from this date
     * - `end_date` - Filter entries until this date
     *
     * # Responses
     * - `200 OK` - Returns list of ledger entries
     * - `404 Not Found` - Credit entitlement not found
     * - `500 Internal Server Error` - Database or server error
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
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'creditEntitlementID' => $creditEntitlementID,
                'endDate' => $endDate,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'startDate' => $startDate,
                'transactionType' => $transactionType,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listLedger($customerID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
