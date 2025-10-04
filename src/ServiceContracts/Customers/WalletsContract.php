<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Customers;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Wallets\WalletListResponse;
use Dodopayments\RequestOptions;

interface WalletsContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function list(
        string $customerID,
        ?RequestOptions $requestOptions = null
    ): WalletListResponse;
}
