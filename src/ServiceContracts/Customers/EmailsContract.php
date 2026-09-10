<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Customers;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Emails\EmailBody;
use Dodopayments\Customers\Emails\EmailLogItem;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface EmailsContract
{
    /**
     * @api
     *
     * @param string $customerID The customer's id
     * @param int $pageNumber Which page to return. The default is 0.
     * @param int $pageSize How many emails to return. The default is 10 and the maximum is 100.
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<EmailLogItem>
     *
     * @throws APIException
     */
    public function list(
        string $customerID,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param string $emailLogID The email log entry's id
     * @param string $customerID The customer's id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveBody(
        string $emailLogID,
        string $customerID,
        RequestOptions|array|null $requestOptions = null,
    ): EmailBody;
}
