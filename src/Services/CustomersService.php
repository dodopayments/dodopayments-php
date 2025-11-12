<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Customer;
use Dodopayments\Customers\CustomerCreateParams;
use Dodopayments\Customers\CustomerListParams;
use Dodopayments\Customers\CustomerUpdateParams;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\CustomersContract;
use Dodopayments\Services\Customers\CustomerPortalService;
use Dodopayments\Services\Customers\WalletsService;

final class CustomersService implements CustomersContract
{
    /**
     * @api
     */
    public CustomerPortalService $customerPortal;

    /**
     * @api
     */
    public WalletsService $wallets;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->customerPortal = new CustomerPortalService($client);
        $this->wallets = new WalletsService($client);
    }

    /**
     * @api
     *
     * @param array{
     *   email: string, name: string, phone_number?: string|null
     * }|CustomerCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|CustomerCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): Customer {
        [$parsed, $options] = CustomerCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'customers',
            body: (object) $parsed,
            options: $options,
            convert: Customer::class,
        );
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $customerID,
        ?RequestOptions $requestOptions = null
    ): Customer {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['customers/%1$s', $customerID],
            options: $requestOptions,
            convert: Customer::class,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   name?: string|null, phone_number?: string|null
     * }|CustomerUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $customerID,
        array|CustomerUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Customer {
        [$parsed, $options] = CustomerUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'patch',
            path: ['customers/%1$s', $customerID],
            body: (object) $parsed,
            options: $options,
            convert: Customer::class,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   email?: string, page_number?: int, page_size?: int
     * }|CustomerListParams $params
     *
     * @return DefaultPageNumberPagination<Customer>
     *
     * @throws APIException
     */
    public function list(
        array|CustomerListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = CustomerListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'customers',
            query: $parsed,
            options: $options,
            convert: Customer::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
