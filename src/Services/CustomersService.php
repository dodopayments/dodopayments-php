<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\Customers\Customer;
use Dodopayments\Customers\CustomerCreateParams;
use Dodopayments\Customers\CustomerListParams;
use Dodopayments\Customers\CustomerUpdateParams;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\CustomersContract;
use Dodopayments\Services\Customers\CustomerPortalService;

use const Dodopayments\Core\OMIT as omit;

final class CustomersService implements CustomersContract
{
    /**
     * @@api
     */
    public CustomerPortalService $customerPortal;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->customerPortal = new CustomerPortalService($client);
    }

    /**
     * @api
     *
     * @param string $email
     * @param string $name
     * @param string|null $phoneNumber
     *
     * @return Customer<HasRawResponse>
     */
    public function create(
        $email,
        $name,
        $phoneNumber = omit,
        ?RequestOptions $requestOptions = null
    ): Customer {
        [$parsed, $options] = CustomerCreateParams::parseRequest(
            ['email' => $email, 'name' => $name, 'phoneNumber' => $phoneNumber],
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
     * @return Customer<HasRawResponse>
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
     * @param string|null $name
     * @param string|null $phoneNumber
     *
     * @return Customer<HasRawResponse>
     */
    public function update(
        string $customerID,
        $name = omit,
        $phoneNumber = omit,
        ?RequestOptions $requestOptions = null,
    ): Customer {
        [$parsed, $options] = CustomerUpdateParams::parseRequest(
            ['name' => $name, 'phoneNumber' => $phoneNumber],
            $requestOptions
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
     * @param string $email Filter by customer email
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     *
     * @return DefaultPageNumberPagination<Customer>
     */
    public function list(
        $email = omit,
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        [$parsed, $options] = CustomerListParams::parseRequest(
            ['email' => $email, 'pageNumber' => $pageNumber, 'pageSize' => $pageSize],
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
