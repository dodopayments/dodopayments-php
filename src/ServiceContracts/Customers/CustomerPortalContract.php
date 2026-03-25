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
     * @param string $returnURL Optional return URL for this session. Overrides the business-level default.
     * This URL will be shown as a "Return to {business}" back button in the portal.
     * @param bool $sendEmail if true, will send link to user
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $customerID,
        ?string $returnURL = null,
        ?bool $sendEmail = null,
        RequestOptions|array|null $requestOptions = null,
    ): CustomerPortalSession;
}
