<?php

declare(strict_types=1);

namespace Dodopayments\Services\Customers;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\Customers\Wallets\WalletListResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Customers\WalletsContract;
use Dodopayments\Services\Customers\Wallets\LedgerEntriesService;

final class WalletsService implements WalletsContract
{
    /**
     * @@api
     */
    public LedgerEntriesService $ledgerEntries;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->ledgerEntries = new LedgerEntriesService($client);
    }

    /**
     * @api
     *
     * @return WalletListResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function list(
        string $customerID,
        ?RequestOptions $requestOptions = null
    ): WalletListResponse {
        $params = [];

        return $this->listRaw($customerID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return WalletListResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        string $customerID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): WalletListResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['customers/%1$s/wallets', $customerID],
            options: $requestOptions,
            convert: WalletListResponse::class,
        );
    }
}
