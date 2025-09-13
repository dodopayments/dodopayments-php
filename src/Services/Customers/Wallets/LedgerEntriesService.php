<?php

declare(strict_types=1);

namespace Dodopayments\Services\Customers\Wallets;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Wallets\CustomerWallet;
use Dodopayments\Customers\Wallets\LedgerEntries\CustomerWalletTransaction;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryCreateParams;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryCreateParams\EntryType;
use Dodopayments\Customers\Wallets\LedgerEntries\LedgerEntryListParams;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Customers\Wallets\LedgerEntriesContract;

use const Dodopayments\Core\OMIT as omit;

final class LedgerEntriesService implements LedgerEntriesContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

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
    ): CustomerWallet {
        $params = [
            'amount' => $amount,
            'currency' => $currency,
            'entryType' => $entryType,
            'idempotencyKey' => $idempotencyKey,
            'reason' => $reason,
        ];

        return $this->createRaw($customerID, $params, $requestOptions);
    }

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
        ?RequestOptions $requestOptions = null
    ): CustomerWallet {
        [$parsed, $options] = LedgerEntryCreateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
    ): DefaultPageNumberPagination {
        $params = [
            'currency' => $currency,
            'pageNumber' => $pageNumber,
            'pageSize' => $pageSize,
        ];

        return $this->listRaw($customerID, $params, $requestOptions);
    }

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
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = LedgerEntryListParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['customers/%1$s/wallets/ledger-entries', $customerID],
            query: $parsed,
            options: $options,
            convert: CustomerWalletTransaction::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
