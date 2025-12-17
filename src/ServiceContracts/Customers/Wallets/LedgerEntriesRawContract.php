<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Customers\Wallets;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Wallets\CustomerWallet;
use Dodopayments\Customers\Wallets\LedgerEntries\CustomerWalletTransaction;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryCreateParams;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryListParams;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

interface LedgerEntriesRawContract
{
    /**
     * @api
     *
     * @param string $customerID Customer ID
     * @param array<string,mixed>|LedgerEntryCreateParams $params
     *
     * @return BaseResponse<CustomerWallet>
     *
     * @throws APIException
     */
    public function create(
        string $customerID,
        array|LedgerEntryCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $customerID Customer ID
     * @param array<string,mixed>|LedgerEntryListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<CustomerWalletTransaction>>
     *
     * @throws APIException
     */
    public function list(
        string $customerID,
        array|LedgerEntryListParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
