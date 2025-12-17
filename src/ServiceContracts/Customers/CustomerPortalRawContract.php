<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Customers;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\CustomerPortal\CustomerPortalCreateParams;
use Dodopayments\Customers\CustomerPortalSession;
use Dodopayments\RequestOptions;

interface CustomerPortalRawContract
{
    /**
     * @api
     *
     * @param string $customerID Customer Id
     * @param array<string,mixed>|CustomerPortalCreateParams $params
     *
     * @return BaseResponse<CustomerPortalSession>
     *
     * @throws APIException
     */
    public function create(
        string $customerID,
        array|CustomerPortalCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
