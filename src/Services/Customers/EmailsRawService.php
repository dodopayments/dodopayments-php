<?php

declare(strict_types=1);

namespace Dodopayments\Services\Customers;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Customers\Emails\EmailBody;
use Dodopayments\Customers\Emails\EmailListParams;
use Dodopayments\Customers\Emails\EmailLogItem;
use Dodopayments\Customers\Emails\EmailRetrieveBodyParams;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Customers\EmailsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class EmailsRawService implements EmailsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns every transactional email sent to this customer in the last 180
     * days, newest first, with its delivery outcome. Delivery status comes from
     * the email provider and is as fresh as replication, typically seconds.
     *
     * @param string $customerID The customer's id
     * @param array{pageNumber?: int, pageSize?: int}|EmailListParams $params
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
    ): BaseResponse {
        [$parsed, $options] = EmailListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['customers/%1$s/emails', $customerID],
            query: Util::array_transform_keys(
                $parsed,
                ['pageNumber' => 'page_number', 'pageSize' => 'page_size']
            ),
            options: $options,
            convert: EmailLogItem::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * Returns the email exactly as it was sent, plus the reason it failed when it
     * did. Some emails have no body to show: an authentication email carries a
     * live login token, a blocked email never reached the provider, and the
     * provider clears bodies at 180 days.
     *
     * @param string $emailLogID The email log entry's id
     * @param array{customerID: string}|EmailRetrieveBodyParams $params
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
    ): BaseResponse {
        [$parsed, $options] = EmailRetrieveBodyParams::parseRequest(
            $params,
            $requestOptions,
        );
        $customerID = $parsed['customerID'];
        unset($parsed['customerID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['customers/%1$s/emails/%2$s/body', $customerID, $emailLogID],
            options: $options,
            convert: EmailBody::class,
        );
    }
}
