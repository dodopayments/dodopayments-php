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
     *
     * @throws APIException
     */
    public function create(
        string $email,
        string $name,
        ?array $metadata = null,
        ?string $phoneNumber = null,
        ?RequestOptions $requestOptions = null,
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
     *
     * @throws APIException
     */
    public function retrieve(
        string $customerID,
        ?RequestOptions $requestOptions = null
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
     *
     * @throws APIException
     */
    public function update(
        string $customerID,
        ?array $metadata = null,
        ?string $name = null,
        ?string $phoneNumber = null,
        ?RequestOptions $requestOptions = null,
    ): Customer {
        $params = Util::removeNulls(
            ['metadata' => $metadata, 'name' => $name, 'phoneNumber' => $phoneNumber]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($customerID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

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
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            ['email' => $email, 'pageNumber' => $pageNumber, 'pageSize' => $pageSize]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

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
    ): CustomerGetPaymentMethodsResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrievePaymentMethods($customerID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
