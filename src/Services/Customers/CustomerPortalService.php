<?php

declare(strict_types=1);

namespace Dodopayments\Services\Customers;

use Dodopayments\Client;
use Dodopayments\Contracts\Customers\CustomerPortalContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Customers\CustomerPortal\CustomerPortalCreateParams;
use Dodopayments\Customers\CustomerPortalSession;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

final class CustomerPortalService implements CustomerPortalContract
{
    public function __construct(private Client $client) {}

    /**
     * @param bool $sendEmail if true, will send link to user
     */
    public function create(
        string $customerID,
        $sendEmail = omit,
        ?RequestOptions $requestOptions = null,
    ): CustomerPortalSession {
        [$parsed, $options] = CustomerPortalCreateParams::parseRequest(
            ['sendEmail' => $sendEmail],
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: ['customers/%1$s/customer-portal/session', $customerID],
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(CustomerPortalSession::class, value: $resp);
    }
}
