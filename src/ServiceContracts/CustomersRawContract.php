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

interface CustomersRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|CustomerCreateParams $params
     *
     * @return BaseResponse<Customer>
     *
     * @throws APIException
     */
    public function create(
        array|CustomerCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $customerID Customer Id
     * @param array<mixed>|CustomerUpdateParams $params
     *
     * @return BaseResponse<Customer>
     *
     * @throws APIException
     */
    public function update(
        string $customerID,
        array|CustomerUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|CustomerListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<Customer>>
     *
     * @throws APIException
     */
    public function list(
        array|CustomerListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

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
    ): BaseResponse;
}
