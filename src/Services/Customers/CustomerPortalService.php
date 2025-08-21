<?php

declare(strict_types=1);

namespace Dodopayments\Services\Customers;

use Dodopayments\Client;
use Dodopayments\Contracts\Customers\CustomerPortalContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Core\Util;
use Dodopayments\Customers\CustomerPortal\CustomerPortalCreateParams;
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
        $args = ['sendEmail' => $sendEmail];
        $args = Util::array_filter_null($args, ['sendEmail']);
        [$parsed, $options] = CustomerPortalCreateParams::parseRequest(
            $args,
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
