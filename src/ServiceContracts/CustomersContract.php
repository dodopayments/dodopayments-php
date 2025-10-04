<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Customer;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

interface CustomersContract
{
    /**
     * @api
     *
     * @param string $email
     * @param string $name
     * @param string|null $phoneNumber
     *
     * @throws APIException
     */
    public function create(
        $email,
        $name,
        $phoneNumber = omit,
        ?RequestOptions $requestOptions = null,
    ): Customer;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
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
     * @param string|null $name
     * @param string|null $phoneNumber
     *
     * @throws APIException
     */
    public function update(
        string $customerID,
        $name = omit,
        $phoneNumber = omit,
        ?RequestOptions $requestOptions = null,
    ): Customer;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $customerID,
        array $params,
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
        $email = omit,
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return DefaultPageNumberPagination<Customer>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination;
}
