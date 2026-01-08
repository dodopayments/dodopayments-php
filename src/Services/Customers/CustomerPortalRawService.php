<?php

declare(strict_types=1);

namespace Dodopayments\Services\Customers;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Customers\CustomerPortal\CustomerPortalCreateParams;
use Dodopayments\Customers\CustomerPortalSession;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Customers\CustomerPortalRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class CustomerPortalRawService implements CustomerPortalRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param string $customerID Customer Id
     * @param array{sendEmail?: bool}|CustomerPortalCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CustomerPortalSession>
     *
     * @throws APIException
     */
    public function create(
        string $customerID,
        array|CustomerPortalCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CustomerPortalCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['customers/%1$s/customer-portal/session', $customerID],
            query: Util::array_transform_keys($parsed, ['sendEmail' => 'send_email']),
            options: $options,
            convert: CustomerPortalSession::class,
        );
    }
}
