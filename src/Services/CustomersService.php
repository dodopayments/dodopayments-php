<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Customers\Customer;
use Dodopayments\Customers\CustomerGetPaymentMethodsResponse;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\CustomersContract;
use Dodopayments\Services\Customers\CustomerPortalService;
use Dodopayments\Services\Customers\WalletsService;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class CustomersService implements CustomersContract
{
    /**
     * @api
     */
    public CustomersRawService $raw;

    /**
     * @api
     */
    public CustomerPortalService $customerPortal;

    /**
     * @api
     */
    public WalletsService $wallets;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CustomersRawService($client);
        $this->customerPortal = new CustomerPortalService($client);
        $this->wallets = new WalletsService($client);
    }

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
    ): Customer {
        $params = Util::removeNulls(
            [
                'email' => $email,
                'name' => $name,
                'metadata' => $metadata,
                'phoneNumber' => $phoneNumber,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

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
    ): Customer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($customerID, requestOptions: $requestOptions);

        return $response->parse();
    }

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
        ?string $email = null,
        ?array $metadata = null,
        ?string $name = null,
        ?string $phoneNumber = null,
        RequestOptions|array|null $requestOptions = null,
    ): Customer {
        $params = Util::removeNulls(
            [
                'email' => $email,
                'metadata' => $metadata,
                'name' => $name,
                'phoneNumber' => $phoneNumber,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($customerID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

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
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'createdAtGte' => $createdAtGte,
                'createdAtLte' => $createdAtLte,
                'email' => $email,
                'name' => $name,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

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
    ): CustomerGetPaymentMethodsResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrievePaymentMethods($customerID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
