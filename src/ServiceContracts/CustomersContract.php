<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Customers\Customer;
use Dodopayments\Customers\CustomerGetPaymentMethodsResponse;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface CustomersContract
{
    /**
     * @api
     *
     * @param array<string,string> $metadata Additional metadata for the customer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $email,
        string $name,
        ?array $metadata = null,
        ?string $phoneNumber = null,
        RequestOptions|array|null $requestOptions = null,
    ): Customer;

    /**
     * @api
     *
     * @param string $customerID Customer Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $customerID,
        RequestOptions|array|null $requestOptions = null
    ): Customer;

    /**
     * @api
     *
     * @param string $customerID Customer Id
     * @param array<string,string>|null $metadata Additional metadata for the customer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $customerID,
        ?array $metadata = null,
        ?string $name = null,
        ?string $phoneNumber = null,
        RequestOptions|array|null $requestOptions = null,
    ): Customer;

    /**
     * @api
     *
     * @param \DateTimeInterface $createdAtGte Filter customers created on or after this timestamp
     * @param \DateTimeInterface $createdAtLte Filter customers created on or before this timestamp
     * @param string $email Filter by customer email
     * @param string $name Filter by customer name (partial match, case-insensitive)
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<Customer>
     *
     * @throws APIException
     */
    public function list(
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $email = null,
        ?string $name = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param string $customerID Customer Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrievePaymentMethods(
        string $customerID,
        RequestOptions|array|null $requestOptions = null
    ): CustomerGetPaymentMethodsResponse;
}
