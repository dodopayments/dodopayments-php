<?php

declare(strict_types=1);

namespace Dodopayments\Contracts\Customers;

use Dodopayments\Customers\CustomerPortalSession;
use Dodopayments\RequestOptions;

interface CustomerPortalContract
{
    /**
     * @param bool $sendEmail if true, will send link to user
     */
    public function create(
        string $customerID,
        $sendEmail = null,
        ?RequestOptions $requestOptions = null,
    ): CustomerPortalSession;
}
