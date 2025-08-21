<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\Customers\Customer;
use Dodopayments\RequestOptions;

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
        $phoneNumber = null,
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
        $name = null,
        $phoneNumber = null,
        ?RequestOptions $requestOptions = null,
    ): Customer;

    /**
     * @param string $email Filter by customer email
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     */
    public function list(
        $email = null,
        $pageNumber = null,
        $pageSize = null,
        ?RequestOptions $requestOptions = null,
    ): Customer;
}
