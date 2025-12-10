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
use Dodopayments\ServiceContracts\CustomersRawContract;

final class CustomersRawService implements CustomersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

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
     * @return BaseResponse<Customer>
     *
     * @throws APIException
     */
    public function create(
        array|CustomerCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = CustomerCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
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
     * @param string $customerID Customer Id
     *
     * @return BaseResponse<Customer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $customerID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
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
     * @param string $customerID Customer Id
     * @param array{
     *   metadata?: array<string,string>|null,
     *   name?: string|null,
     *   phoneNumber?: string|null,
     * }|CustomerUpdateParams $params
     *
     * @return BaseResponse<Customer>
     *
     * @throws APIException
     */
    public function update(
        string $customerID,
        array|CustomerUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CustomerUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
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
     *   email?: string, pageNumber?: int, pageSize?: int
     * }|CustomerListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<Customer>>
     *
     * @throws APIException
     */
    public function list(
        array|CustomerListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = CustomerListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
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
    }

    /**
     * @api
     *
     * @param string $customerID Customer Id
     *
     * @return BaseResponse<CustomerGetPaymentMethodsResponse>
     *
     * @throws APIException
     */
    public function retrievePaymentMethods(
        string $customerID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['customers/%1$s/payment-methods', $customerID],
            options: $requestOptions,
            convert: CustomerGetPaymentMethodsResponse::class,
        );
    }
}
