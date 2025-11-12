<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Customers;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\CustomerPortal\CustomerPortalCreateParams;
use Dodopayments\Customers\CustomerPortalSession;
use Dodopayments\RequestOptions;

interface CustomerPortalContract
{
    /**
     * @api
     *
     * @param array<mixed>|CustomerPortalCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        string $customerID,
        array|CustomerPortalCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CustomerPortalSession;
}
