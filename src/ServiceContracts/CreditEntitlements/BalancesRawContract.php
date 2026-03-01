<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\CreditEntitlements;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\CreditEntitlements\Balances\BalanceCreateLedgerEntryParams;
use Dodopayments\CreditEntitlements\Balances\BalanceListGrantsParams;
use Dodopayments\CreditEntitlements\Balances\BalanceListGrantsResponse;
use Dodopayments\CreditEntitlements\Balances\BalanceListLedgerParams;
use Dodopayments\CreditEntitlements\Balances\BalanceListParams;
use Dodopayments\CreditEntitlements\Balances\BalanceNewLedgerEntryResponse;
use Dodopayments\CreditEntitlements\Balances\BalanceRetrieveParams;
use Dodopayments\CreditEntitlements\Balances\CreditLedgerEntry;
use Dodopayments\CreditEntitlements\Balances\CustomerCreditBalance;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface BalancesRawContract
{
    /**
     * @api
     *
     * @param string $customerID Customer ID
     * @param array<string,mixed>|BalanceRetrieveParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $creditEntitlementID Credit Entitlement ID
     * @param array<string,mixed>|BalanceListParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $customerID Path param: Customer ID
     * @param array<string,mixed>|BalanceCreateLedgerEntryParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $customerID Path param: Customer ID
     * @param array<string,mixed>|BalanceListGrantsParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $customerID Path param: Customer ID
     * @param array<string,mixed>|BalanceListLedgerParams $params
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
    ): BaseResponse;
}
