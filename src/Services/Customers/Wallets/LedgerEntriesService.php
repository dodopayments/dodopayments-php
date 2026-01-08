<?php

declare(strict_types=1);

namespace Dodopayments\Services\Customers\Wallets;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Customers\Wallets\CustomerWallet;
use Dodopayments\Customers\Wallets\LedgerEntries\CustomerWalletTransaction;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryCreateParams\EntryType;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Customers\Wallets\LedgerEntriesContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class LedgerEntriesService implements LedgerEntriesContract
{
    /**
     * @api
     */
    public LedgerEntriesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LedgerEntriesRawService($client);
    }

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
    ): CustomerWallet {
        $params = Util::removeNulls(
            [
                'amount' => $amount,
                'currency' => $currency,
                'entryType' => $entryType,
                'idempotencyKey' => $idempotencyKey,
                'reason' => $reason,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($customerID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

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
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'currency' => $currency,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($customerID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
