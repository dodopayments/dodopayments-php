<?php

declare(strict_types=1);

namespace Dodopayments\Services\CreditEntitlements;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\CreditEntitlements\Balances\BalanceCreateLedgerEntryParams;
use Dodopayments\CreditEntitlements\Balances\BalanceListGrantsParams;
use Dodopayments\CreditEntitlements\Balances\BalanceListGrantsParams\Status;
use Dodopayments\CreditEntitlements\Balances\BalanceListGrantsResponse;
use Dodopayments\CreditEntitlements\Balances\BalanceListLedgerParams;
use Dodopayments\CreditEntitlements\Balances\BalanceListParams;
use Dodopayments\CreditEntitlements\Balances\BalanceNewLedgerEntryResponse;
use Dodopayments\CreditEntitlements\Balances\BalanceRetrieveParams;
use Dodopayments\CreditEntitlements\Balances\CreditLedgerEntry;
use Dodopayments\CreditEntitlements\Balances\CustomerCreditBalance;
use Dodopayments\CreditEntitlements\Balances\LedgerEntryType;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\CreditEntitlements\BalancesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class BalancesRawService implements BalancesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

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
     * @param array{creditEntitlementID: string}|BalanceRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CustomerCreditBalance>
     *
     * @throws APIException
     */
    public function retrieve(
        string $customerID,
        array|BalanceRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BalanceRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $creditEntitlementID = $parsed['creditEntitlementID'];
        unset($parsed['creditEntitlementID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'credit-entitlements/%1$s/balances/%2$s',
                $creditEntitlementID,
                $customerID,
            ],
            options: $options,
            convert: CustomerCreditBalance::class,
        );
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
     * @param array{
     *   customerID?: string, pageNumber?: int, pageSize?: int
     * }|BalanceListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<CustomerCreditBalance>>
     *
     * @throws APIException
     */
    public function list(
        string $creditEntitlementID,
        array|BalanceListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BalanceListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['credit-entitlements/%1$s/balances', $creditEntitlementID],
            query: Util::array_transform_keys(
                $parsed,
                [
                    'customerID' => 'customer_id',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                ],
            ),
            options: $options,
            convert: CustomerCreditBalance::class,
            page: DefaultPageNumberPagination::class,
        );
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
     * @param array{
     *   creditEntitlementID: string,
     *   amount: string,
     *   entryType: LedgerEntryType|value-of<LedgerEntryType>,
     *   expiresAt?: \DateTimeInterface|null,
     *   idempotencyKey?: string|null,
     *   metadata?: array<string,string>|null,
     *   reason?: string|null,
     * }|BalanceCreateLedgerEntryParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BalanceNewLedgerEntryResponse>
     *
     * @throws APIException
     */
    public function createLedgerEntry(
        string $customerID,
        array|BalanceCreateLedgerEntryParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BalanceCreateLedgerEntryParams::parseRequest(
            $params,
            $requestOptions,
        );
        $creditEntitlementID = $parsed['creditEntitlementID'];
        unset($parsed['creditEntitlementID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'credit-entitlements/%1$s/balances/%2$s/ledger-entries',
                $creditEntitlementID,
                $customerID,
            ],
            body: (object) array_diff_key(
                $parsed,
                array_flip(['creditEntitlementID'])
            ),
            options: $options,
            convert: BalanceNewLedgerEntryResponse::class,
        );
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
     * @param array{
     *   creditEntitlementID: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   status?: Status|value-of<Status>,
     * }|BalanceListGrantsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<BalanceListGrantsResponse>>
     *
     * @throws APIException
     */
    public function listGrants(
        string $customerID,
        array|BalanceListGrantsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BalanceListGrantsParams::parseRequest(
            $params,
            $requestOptions,
        );
        $creditEntitlementID = $parsed['creditEntitlementID'];
        unset($parsed['creditEntitlementID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'credit-entitlements/%1$s/balances/%2$s/grants',
                $creditEntitlementID,
                $customerID,
            ],
            query: Util::array_transform_keys(
                $parsed,
                ['pageNumber' => 'page_number', 'pageSize' => 'page_size']
            ),
            options: $options,
            convert: BalanceListGrantsResponse::class,
            page: DefaultPageNumberPagination::class,
        );
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
     * @param array{
     *   creditEntitlementID: string,
     *   endDate?: \DateTimeInterface,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   startDate?: \DateTimeInterface,
     *   transactionType?: string,
     * }|BalanceListLedgerParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<CreditLedgerEntry>>
     *
     * @throws APIException
     */
    public function listLedger(
        string $customerID,
        array|BalanceListLedgerParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BalanceListLedgerParams::parseRequest(
            $params,
            $requestOptions,
        );
        $creditEntitlementID = $parsed['creditEntitlementID'];
        unset($parsed['creditEntitlementID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'credit-entitlements/%1$s/balances/%2$s/ledger',
                $creditEntitlementID,
                $customerID,
            ],
            query: Util::array_transform_keys(
                $parsed,
                [
                    'endDate' => 'end_date',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                    'startDate' => 'start_date',
                    'transactionType' => 'transaction_type',
                ],
            ),
            options: $options,
            convert: CreditLedgerEntry::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
