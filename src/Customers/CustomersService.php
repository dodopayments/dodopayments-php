<?php

declare(strict_types=1);

namespace DodoPayments\Customers;

use DodoPayments\Client;
use DodoPayments\Contracts\CustomersContract;
use DodoPayments\Core\Conversion;
use DodoPayments\Customers\CustomerPortal\CustomerPortalService;
use DodoPayments\RequestOptions;

final class CustomersService implements CustomersContract
{
    public CustomerPortalService $customerPortal;

    public function __construct(private Client $client)
    {
        $this->customerPortal = new CustomerPortalService($this->client);
    }

    /**
     * @param array{
     *   email: string, name: string, phoneNumber?: null|string
     * }|CustomerCreateParams $params
     */
    public function create(
        array|CustomerCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): Customer {
        [$parsed, $options] = CustomerCreateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'customers',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Customer::class, value: $resp);
    }

    public function retrieve(
        string $customerID,
        ?RequestOptions $requestOptions = null
    ): Customer {
        $resp = $this->client->request(
            method: 'get',
            path: ['customers/%1$s', $customerID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Customer::class, value: $resp);
    }

    /**
     * @param array{
     *   name?: null|string, phoneNumber?: null|string
     * }|CustomerUpdateParams $params
     */
    public function update(
        string $customerID,
        array|CustomerUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Customer {
        [$parsed, $options] = CustomerUpdateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'patch',
            path: ['customers/%1$s', $customerID],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Customer::class, value: $resp);
    }

    /**
     * @param array{
     *   email?: string, pageNumber?: int, pageSize?: int
     * }|CustomerListParams $params
     */
    public function list(
        array|CustomerListParams $params,
        ?RequestOptions $requestOptions = null
    ): Customer {
        [$parsed, $options] = CustomerListParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'customers',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Customer::class, value: $resp);
    }
}
