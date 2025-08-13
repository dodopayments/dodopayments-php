<?php

declare(strict_types=1);

namespace DodopaymentsClient\Contracts\Customers;

use DodopaymentsClient\Customers\CustomerPortal\CustomerPortalCreateParams;
use DodopaymentsClient\Customers\CustomerPortalSession;
use DodopaymentsClient\RequestOptions;

interface CustomerPortalContract
{
    /**
     * @param array{sendEmail?: bool}|CustomerPortalCreateParams $params
     */
    public function create(
        string $customerID,
        array|CustomerPortalCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CustomerPortalSession;
}
