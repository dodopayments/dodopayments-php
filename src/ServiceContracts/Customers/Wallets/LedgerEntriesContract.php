<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Customers\Wallets;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Wallets\CustomerWallet;
use Dodopayments\Customers\Wallets\LedgerEntries\CustomerWalletTransaction;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryCreateParams\EntryType;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

interface LedgerEntriesContract
{
    /**
     * @api
     *
     * @param int $amount
     * @param Currency|value-of<Currency> $currency Currency of the wallet to adjust
     * @param EntryType|value-of<EntryType> $entryType Type of ledger entry - credit or debit
     * @param string|null $idempotencyKey Optional idempotency key to prevent duplicate entries
     * @param string|null $reason
     *
     * @throws APIException
     */
    public function create(
        string $customerID,
        $amount,
        $currency,
        $entryType,
        $idempotencyKey = omit,
        $reason = omit,
        ?RequestOptions $requestOptions = null,
    ): CustomerWallet;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createRaw(
        string $customerID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): CustomerWallet;

    /**
     * @api
     *
     * @param Currency|value-of<Currency> $currency Optional currency filter
     * @param int $pageNumber
     * @param int $pageSize
     *
     * @return DefaultPageNumberPagination<CustomerWalletTransaction>
     *
     * @throws APIException
     */
    public function list(
        string $customerID,
        $currency = omit,
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return DefaultPageNumberPagination<CustomerWalletTransaction>
     *
     * @throws APIException
     */
    public function listRaw(
        string $customerID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;
}
