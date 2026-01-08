<?php

declare(strict_types=1);

namespace Dodopayments\Services\Customers\Wallets;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Customers\Wallets\CustomerWallet;
use Dodopayments\Customers\Wallets\LedgerEntries\CustomerWalletTransaction;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryCreateParams;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryCreateParams\EntryType;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryListParams;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Customers\Wallets\LedgerEntriesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class LedgerEntriesRawService implements LedgerEntriesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param string $customerID Customer ID
     * @param array{
     *   amount: int,
     *   currency: value-of<Currency>,
     *   entryType: EntryType|value-of<EntryType>,
     *   idempotencyKey?: string|null,
     *   reason?: string|null,
     * }|LedgerEntryCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CustomerWallet>
     *
     * @throws APIException
     */
    public function create(
        string $customerID,
        array|LedgerEntryCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LedgerEntryCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['customers/%1$s/wallets/ledger-entries', $customerID],
            body: (object) $parsed,
            options: $options,
            convert: CustomerWallet::class,
        );
    }

    /**
     * @api
     *
     * @param string $customerID Customer ID
     * @param array{
     *   currency?: value-of<Currency>, pageNumber?: int, pageSize?: int
     * }|LedgerEntryListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<CustomerWalletTransaction>>
     *
     * @throws APIException
     */
    public function list(
        string $customerID,
        array|LedgerEntryListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LedgerEntryListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['customers/%1$s/wallets/ledger-entries', $customerID],
            query: Util::array_transform_keys(
                $parsed,
                ['pageNumber' => 'page_number', 'pageSize' => 'page_size']
            ),
            options: $options,
            convert: CustomerWalletTransaction::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
