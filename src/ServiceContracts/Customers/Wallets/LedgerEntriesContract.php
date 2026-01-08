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

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface LedgerEntriesContract
{
    /**
     * @api
     *
     * @param string $customerID Customer ID
     * @param Currency|value-of<Currency> $currency Currency of the wallet to adjust
     * @param EntryType|value-of<EntryType> $entryType Type of ledger entry - credit or debit
     * @param string|null $idempotencyKey Optional idempotency key to prevent duplicate entries
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $customerID,
        int $amount,
        Currency|string $currency,
        EntryType|string $entryType,
        ?string $idempotencyKey = null,
        ?string $reason = null,
        RequestOptions|array|null $requestOptions = null,
    ): CustomerWallet;

    /**
     * @api
     *
     * @param string $customerID Customer ID
     * @param Currency|value-of<Currency> $currency Optional currency filter
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<CustomerWalletTransaction>
     *
     * @throws APIException
     */
    public function list(
        string $customerID,
        Currency|string|null $currency = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;
}
