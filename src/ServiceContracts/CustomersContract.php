<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Customer;
use Dodopayments\Customers\CustomerCreateParams;
use Dodopayments\Customers\CustomerListParams;
use Dodopayments\Customers\CustomerUpdateParams;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

interface CustomersContract
{
    /**
     * @api
     *
     * @param array<mixed>|CustomerCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|CustomerCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Customer;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $customerID,
        ?RequestOptions $requestOptions = null
    ): Customer;

    /**
     * @api
     *
     * @param array<mixed>|CustomerUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $customerID,
        array|CustomerUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Customer;

    /**
     * @api
     *
     * @param array<mixed>|CustomerListParams $params
     *
     * @return DefaultPageNumberPagination<Customer>
     *
     * @throws APIException
     */
    public function list(
        array|CustomerListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination;
}
