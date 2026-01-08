<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Customer;
use Dodopayments\Customers\CustomerCreateParams;
use Dodopayments\Customers\CustomerGetPaymentMethodsResponse;
use Dodopayments\Customers\CustomerListParams;
use Dodopayments\Customers\CustomerUpdateParams;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface CustomersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CustomerCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Customer>
     *
     * @throws APIException
     */
    public function create(
        array|CustomerCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $customerID Customer Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Customer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $customerID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $customerID Customer Id
     * @param array<string,mixed>|CustomerUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Customer>
     *
     * @throws APIException
     */
    public function update(
        string $customerID,
        array|CustomerUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CustomerListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<Customer>>
     *
     * @throws APIException
     */
    public function list(
        array|CustomerListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $customerID Customer Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CustomerGetPaymentMethodsResponse>
     *
     * @throws APIException
     */
    public function retrievePaymentMethods(
        string $customerID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
