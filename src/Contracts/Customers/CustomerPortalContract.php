<?php

declare(strict_types=1);

namespace DodoPayments\Contracts\Customers;

use DodoPayments\Customers\CustomerPortal\CustomerPortalCreateParams;
use DodoPayments\Customers\CustomerPortalSession;
use DodoPayments\RequestOptions;

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
