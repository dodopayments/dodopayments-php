<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Customer;
use Dodopayments\Customers\CustomerGetPaymentMethodsResponse;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

interface CustomersContract
{
    /**
     * @api
     *
     * @param array<string,string> $metadata Additional metadata for the customer
     *
     * @throws APIException
     */
    public function create(
        string $email,
        string $name,
        ?array $metadata = null,
        ?string $phoneNumber = null,
        ?RequestOptions $requestOptions = null,
    ): Customer;

    /**
     * @api
     *
     * @param string $customerID Customer Id
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
     * @param string $customerID Customer Id
     * @param array<string,string>|null $metadata Additional metadata for the customer
     *
     * @throws APIException
     */
    public function update(
        string $customerID,
        ?array $metadata = null,
        ?string $name = null,
        ?string $phoneNumber = null,
        ?RequestOptions $requestOptions = null,
    ): Customer;

    /**
     * @api
     *
     * @param string $email Filter by customer email
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     *
     * @return DefaultPageNumberPagination<Customer>
     *
     * @throws APIException
     */
    public function list(
        ?string $email = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param string $customerID Customer Id
     *
     * @throws APIException
     */
    public function retrievePaymentMethods(
        string $customerID,
        ?RequestOptions $requestOptions = null
    ): CustomerGetPaymentMethodsResponse;
}
