<?php

declare(strict_types=1);

namespace Dodopayments\Contracts\Customers;

use Dodopayments\Customers\CustomerPortal\CustomerPortalCreateParams;
use Dodopayments\Customers\CustomerPortalSession;
use Dodopayments\RequestOptions;

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
