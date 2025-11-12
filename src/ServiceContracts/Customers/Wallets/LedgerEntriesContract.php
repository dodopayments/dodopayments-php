<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Customers\Wallets;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Wallets\CustomerWallet;
use Dodopayments\Customers\Wallets\LedgerEntries\CustomerWalletTransaction;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryCreateParams;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryListParams;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

interface LedgerEntriesContract
{
    /**
     * @api
     *
     * @param array<mixed>|LedgerEntryCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        string $customerID,
        array|LedgerEntryCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CustomerWallet;

    /**
     * @api
     *
     * @param array<mixed>|LedgerEntryListParams $params
     *
     * @return DefaultPageNumberPagination<CustomerWalletTransaction>
     *
     * @throws APIException
     */
    public function list(
        string $customerID,
        array|LedgerEntryListParams $params,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;
}
