<?php

declare(strict_types=1);

namespace Dodopayments\Services\Customers;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Customers\Emails\EmailBody;
use Dodopayments\Customers\Emails\EmailLogItem;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Customers\EmailsContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class EmailsService implements EmailsContract
{
    /**
     * @api
     */
    public EmailsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new EmailsRawService($client);
    }

    /**
     * @api
     *
     * Returns every transactional email sent to this customer in the last 180
     * days, newest first, with its delivery outcome. Delivery status comes from
     * the email provider and is as fresh as replication, typically seconds.
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
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            ['pageNumber' => $pageNumber, 'pageSize' => $pageSize]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($customerID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param string $customerID The customer's id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveBody(
        string $emailLogID,
        string $customerID,
        RequestOptions|array|null $requestOptions = null,
    ): EmailBody {
        $params = Util::removeNulls(['customerID' => $customerID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveBody($emailLogID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
