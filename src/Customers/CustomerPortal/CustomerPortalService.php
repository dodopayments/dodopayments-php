<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerPortal;

use Dodopayments\Client;
use Dodopayments\Contracts\Customers\CustomerPortalContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Customers\CustomerPortalSession;
use Dodopayments\RequestOptions;

final class CustomerPortalService implements CustomerPortalContract
{
    public function __construct(private Client $client) {}

    /**
     * @param bool $sendEmail if true, will send link to user
     */
    public function create(
        string $customerID,
        $sendEmail = null,
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
