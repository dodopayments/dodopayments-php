<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Customers;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\CustomerPortalSession;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface CustomerPortalContract
{
    /**
     * @api
     *
     * @param string $customerID Customer Id
     * @param bool $sendEmail if true, will send link to user
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $customerID,
        ?bool $sendEmail = null,
        RequestOptions|array|null $requestOptions = null,
    ): CustomerPortalSession;
}
