<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Customers;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Emails\EmailBody;
use Dodopayments\Customers\Emails\EmailListParams;
use Dodopayments\Customers\Emails\EmailLogItem;
use Dodopayments\Customers\Emails\EmailRetrieveBodyParams;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface EmailsRawContract
{
    /**
     * @api
     *
     * @param string $customerID The customer's id
     * @param array<string,mixed>|EmailListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<EmailLogItem>>
     *
     * @throws APIException
     */
    public function list(
        string $customerID,
        array|EmailListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $emailLogID The email log entry's id
     * @param array<string,mixed>|EmailRetrieveBodyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EmailBody>
     *
     * @throws APIException
     */
    public function retrieveBody(
        string $emailLogID,
        array|EmailRetrieveBodyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
