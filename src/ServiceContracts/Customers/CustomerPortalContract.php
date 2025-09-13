<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Customers;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\CustomerPortalSession;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

interface CustomerPortalContract
{
    /**
     * @api
     *
     * @param bool $sendEmail if true, will send link to user
     *
     * @throws APIException
     */
    public function create(
        string $customerID,
        $sendEmail = omit,
        ?RequestOptions $requestOptions = null,
    ): CustomerPortalSession;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createRaw(
        string $customerID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): CustomerPortalSession;
}
