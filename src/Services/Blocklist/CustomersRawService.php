<?php

declare(strict_types=1);

namespace Dodopayments\Services\Blocklist;

use Dodopayments\Blocklist\Customers\BlockedCustomer;
use Dodopayments\Blocklist\Customers\BlockedCustomerSource;
use Dodopayments\Blocklist\Customers\CustomerCreateParams;
use Dodopayments\Blocklist\Customers\CustomerListParams;
use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Blocklist\CustomersRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class CustomersRawService implements CustomersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{
     *   customerID: string,
     *   reason?: string|null,
     *   source?: BlockedCustomerSource|value-of<BlockedCustomerSource>|null,
     *   email: string,
     * }|CustomerCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BlockedCustomer>
     *
     * @throws APIException
     */
    public function create(
        array|CustomerCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CustomerCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'blocklist/customers',
            body: (object) $parsed,
            options: $options,
            convert: BlockedCustomer::class,
        );
    }

    /**
     * @api
     *
     * @param string $entryID Blocklist entry id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BlockedCustomer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $entryID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['blocklist/customers/%1$s', $entryID],
            options: $requestOptions,
            convert: BlockedCustomer::class,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   blockedByEmail?: string|null,
     *   createdAtGte?: \DateTimeInterface|null,
     *   createdAtLte?: \DateTimeInterface|null,
     *   identifier?: string|null,
     *   pageNumber?: int|null,
     *   pageSize?: int|null,
     * }|CustomerListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<BlockedCustomer>>
     *
     * @throws APIException
     */
    public function list(
        array|CustomerListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CustomerListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'blocklist/customers',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'blockedByEmail' => 'blocked_by_email',
                    'createdAtGte' => 'created_at_gte',
                    'createdAtLte' => 'created_at_lte',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                ],
            ),
            options: $options,
            convert: BlockedCustomer::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @param string $entryID Blocklist entry id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $entryID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['blocklist/customers/%1$s', $entryID],
            options: $requestOptions,
            convert: null,
        );
    }
}
