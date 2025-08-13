<?php

declare(strict_types=1);

namespace DodopaymentsClient\Contracts;

use DodopaymentsClient\Customers\Customer;
use DodopaymentsClient\Customers\CustomerCreateParams;
use DodopaymentsClient\Customers\CustomerListParams;
use DodopaymentsClient\Customers\CustomerUpdateParams;
use DodopaymentsClient\RequestOptions;

interface CustomersContract
{
    /**
     * @param array{
     *   email: string, name: string, phoneNumber?: null|string
     * }|CustomerCreateParams $params
     */
    public function create(
        array|CustomerCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Customer;

    public function retrieve(
        string $customerID,
        ?RequestOptions $requestOptions = null
    ): Customer;

    /**
     * @param array{
     *   name?: null|string, phoneNumber?: null|string
     * }|CustomerUpdateParams $params
     */
    public function update(
        string $customerID,
        array|CustomerUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Customer;

    /**
     * @param array{
     *   email?: string, pageNumber?: int, pageSize?: int
     * }|CustomerListParams $params
     */
    public function list(
        array|CustomerListParams $params,
        ?RequestOptions $requestOptions = null
    ): Customer;
}
