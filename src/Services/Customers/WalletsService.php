<?php

declare(strict_types=1);

namespace Dodopayments\Services\Customers;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Wallets\WalletListResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Customers\WalletsContract;
use Dodopayments\Services\Customers\Wallets\LedgerEntriesService;

final class WalletsService implements WalletsContract
{
    /**
     * @api
     */
    public WalletsRawService $raw;

    /**
     * @api
     */
    public LedgerEntriesService $ledgerEntries;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WalletsRawService($client);
        $this->ledgerEntries = new LedgerEntriesService($client);
    }

    /**
     * @api
     *
     * @param string $customerID Customer ID
     *
     * @throws APIException
     */
    public function list(
        string $customerID,
        ?RequestOptions $requestOptions = null
    ): WalletListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($customerID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
