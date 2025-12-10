<?php

declare(strict_types=1);

namespace Dodopayments\Services\Customers;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\CustomerPortalSession;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Customers\CustomerPortalContract;

final class CustomerPortalService implements CustomerPortalContract
{
    /**
     * @api
     */
    public CustomerPortalRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CustomerPortalRawService($client);
    }

    /**
     * @api
     *
     * @param string $customerID Customer Id
     * @param bool $sendEmail if true, will send link to user
     *
     * @throws APIException
     */
    public function create(
        string $customerID,
        ?bool $sendEmail = null,
        ?RequestOptions $requestOptions = null,
    ): CustomerPortalSession {
        $params = ['sendEmail' => $sendEmail];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($customerID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
