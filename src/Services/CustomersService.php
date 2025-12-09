<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Customers\Customer;
use Dodopayments\Customers\CustomerCreateParams;
use Dodopayments\Customers\CustomerGetPaymentMethodsResponse;
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
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>,
     *   phoneNumber?: string|null,
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

        /** @var BaseResponse<Customer> */
        $response = $this->client->request(
            method: 'post',
            path: 'customers',
            body: (object) $parsed,
            options: $options,
            convert: Customer::class,
        );

        return $response->parse();
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
        /** @var BaseResponse<Customer> */
        $response = $this->client->request(
            method: 'get',
            path: ['customers/%1$s', $customerID],
            options: $requestOptions,
            convert: Customer::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{
     *   metadata?: array<string,string>|null,
     *   name?: string|null,
     *   phoneNumber?: string|null,
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

        /** @var BaseResponse<Customer> */
        $response = $this->client->request(
            method: 'patch',
            path: ['customers/%1$s', $customerID],
            body: (object) $parsed,
            options: $options,
            convert: Customer::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{
     *   email?: string, pageNumber?: int, pageSize?: int
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

        /** @var BaseResponse<DefaultPageNumberPagination<Customer>> */
        $response = $this->client->request(
            method: 'get',
            path: 'customers',
            query: Util::array_transform_keys(
                $parsed,
                ['pageNumber' => 'page_number', 'pageSize' => 'page_size']
            ),
            options: $options,
            convert: Customer::class,
            page: DefaultPageNumberPagination::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrievePaymentMethods(
        string $customerID,
        ?RequestOptions $requestOptions = null
    ): CustomerGetPaymentMethodsResponse {
        /** @var BaseResponse<CustomerGetPaymentMethodsResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['customers/%1$s/payment-methods', $customerID],
            options: $requestOptions,
            convert: CustomerGetPaymentMethodsResponse::class,
        );

        return $response->parse();
    }
}
