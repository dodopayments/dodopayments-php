<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Customers;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\Customers\Wallets\WalletListResponse;
use Dodopayments\RequestOptions;

interface WalletsContract
{
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
    ): WalletListResponse;

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
        ?RequestOptions $requestOptions = null,
    ): WalletListResponse;
}
