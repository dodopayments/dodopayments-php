<?php

declare(strict_types=1);

namespace Dodopayments\Core\ServiceContracts;

use Dodopayments\Customers\Customer;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

interface CustomersContract
{
    /**
     * @param string $email
     * @param string $name
     * @param string|null $phoneNumber
     */
    public function create(
        $email,
        $name,
        $phoneNumber = omit,
        ?RequestOptions $requestOptions = null,
    ): Customer;

    public function retrieve(
        string $customerID,
        ?RequestOptions $requestOptions = null
    ): Customer;

    /**
     * @param string|null $name
     * @param string|null $phoneNumber
     */
    public function update(
        string $customerID,
        $name = omit,
        $phoneNumber = omit,
        ?RequestOptions $requestOptions = null,
    ): Customer;

    /**
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
    ): DefaultPageNumberPagination;
}
