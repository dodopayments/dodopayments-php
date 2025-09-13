<?php

declare(strict_types=1);

namespace Dodopayments\Services\Customers;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\CustomerPortal\CustomerPortalCreateParams;
use Dodopayments\Customers\CustomerPortalSession;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Customers\CustomerPortalContract;

use const Dodopayments\Core\OMIT as omit;

final class CustomerPortalService implements CustomerPortalContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

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
    ): CustomerPortalSession {
        $params = ['sendEmail' => $sendEmail];

        return $this->createRaw($customerID, $params, $requestOptions);
    }

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
        ?RequestOptions $requestOptions = null
    ): CustomerPortalSession {
        [$parsed, $options] = CustomerPortalCreateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: ['customers/%1$s/customer-portal/session', $customerID],
            query: $parsed,
            options: $options,
            convert: CustomerPortalSession::class,
        );
    }
}
