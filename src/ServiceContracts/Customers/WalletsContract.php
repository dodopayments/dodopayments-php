<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Customers;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Wallets\WalletListResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface WalletsContract
{
    /**
     * @api
     *
     * @param string $customerID Customer ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $customerID,
        RequestOptions|array|null $requestOptions = null
    ): WalletListResponse;
}
