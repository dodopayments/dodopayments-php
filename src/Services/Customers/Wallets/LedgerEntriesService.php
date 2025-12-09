<?php

declare(strict_types=1);

namespace Dodopayments\Services\Customers\Wallets;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Wallets\CustomerWallet;
use Dodopayments\Customers\Wallets\LedgerEntries\CustomerWalletTransaction;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryCreateParams;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryListParams;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Customers\Wallets\LedgerEntriesContract;

final class LedgerEntriesService implements LedgerEntriesContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{
     *   amount: int,
     *   currency: value-of<Currency>,
     *   entry_type: 'credit'|'debit',
     *   idempotency_key?: string|null,
     *   reason?: string|null,
     * }|LedgerEntryCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        string $customerID,
        array|LedgerEntryCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CustomerWallet {
        [$parsed, $options] = LedgerEntryCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<CustomerWallet> */
        $response = $this->client->request(
            method: 'post',
            path: ['customers/%1$s/wallets/ledger-entries', $customerID],
            body: (object) $parsed,
            options: $options,
            convert: CustomerWallet::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{
     *   currency?: value-of<Currency>, page_number?: int, page_size?: int
     * }|LedgerEntryListParams $params
     *
     * @return DefaultPageNumberPagination<CustomerWalletTransaction>
     *
     * @throws APIException
     */
    public function list(
        string $customerID,
        array|LedgerEntryListParams $params,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        [$parsed, $options] = LedgerEntryListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<DefaultPageNumberPagination<CustomerWalletTransaction,>,> */
        $response = $this->client->request(
            method: 'get',
            path: ['customers/%1$s/wallets/ledger-entries', $customerID],
            query: $parsed,
            options: $options,
            convert: CustomerWalletTransaction::class,
            page: DefaultPageNumberPagination::class,
        );

        return $response->parse();
    }
}
