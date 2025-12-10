<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Customers;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\CustomerPortalSession;
use Dodopayments\RequestOptions;

interface CustomerPortalContract
{
    /**
     * @api
     *
     * @param string $customerID Customer Id
     * @param bool $sendEmail if true, will send link to user
     *
     * @throws APIException
     */
    public function create(
        string $customerID,
        ?bool $sendEmail = null,
        ?RequestOptions $requestOptions = null,
    ): CustomerPortalSession;
}
