<?php

declare(strict_types=1);

namespace Dodopayments\Services\Customers;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Wallets\WalletListResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Customers\WalletsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class WalletsRawService implements WalletsRawContract
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
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WalletListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $customerID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['customers/%1$s/wallets', $customerID],
            options: $requestOptions,
            convert: WalletListResponse::class,
        );
    }
}
