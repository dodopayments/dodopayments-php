<?php

declare(strict_types=1);

namespace Dodopayments\Services\Blocklist;

use Dodopayments\Blocklist\Customers\BlockedCustomer;
use Dodopayments\Blocklist\Customers\BlockedCustomerSource;
use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Blocklist\CustomersContract;
use Dodopayments\Services\Blocklist\Customers\NotesService;

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
    public NotesService $notes;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CustomersRawService($client);
        $this->notes = new NotesService($client);
    }

    /**
     * @api
     *
     * @param string $customerID Customer to block. The block still applies to that customer's email.
     * @param string $email Email to block. It must belong to an existing customer of this business.
     * @param string|null $reason Why the merchant blocked this customer. The entry page shows it.
     * @param BlockedCustomerSource|value-of<BlockedCustomerSource>|null $source Screen the merchant blocked from. Ignored for an API-key caller, whose
     * entry always records `api`. A dashboard caller that omits it records
     * `blocklist_page`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $customerID,
        string $email,
        ?string $reason = null,
        BlockedCustomerSource|string|null $source = null,
        RequestOptions|array|null $requestOptions = null,
    ): BlockedCustomer {
        $params = Util::removeNulls(
            [
                'customerID' => $customerID,
                'reason' => $reason,
                'source' => $source,
                'email' => $email,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $entryID Blocklist entry id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $entryID,
        RequestOptions|array|null $requestOptions = null
    ): BlockedCustomer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($entryID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string|null $blockedByEmail filter by the dashboard user who blocked the customer
     * @param \DateTimeInterface|null $createdAtGte blocked on or after this time
     * @param \DateTimeInterface|null $createdAtLte blocked on or before this time
     * @param string|null $identifier partial, case-insensitive match on the email and on the customer id
     * @param int|null $pageNumber Page number. Default 0.
     * @param int|null $pageSize Page size. Default 10, maximum 100.
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<BlockedCustomer>
     *
     * @throws APIException
     */
    public function list(
        ?string $blockedByEmail = null,
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $identifier = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'blockedByEmail' => $blockedByEmail,
                'createdAtGte' => $createdAtGte,
                'createdAtLte' => $createdAtLte,
                'identifier' => $identifier,
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
     * @param string $entryID Blocklist entry id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $entryID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($entryID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
