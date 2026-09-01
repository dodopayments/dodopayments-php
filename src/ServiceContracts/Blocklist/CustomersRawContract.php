<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Blocklist;

use Dodopayments\Blocklist\Customers\BlockedCustomer;
use Dodopayments\Blocklist\Customers\CustomerCreateParams;
use Dodopayments\Blocklist\Customers\CustomerListParams;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface CustomersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CustomerCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BlockedCustomer>
     *
     * @throws APIException
     */
    public function create(
        array|CustomerCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CustomerListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<BlockedCustomer>>
     *
     * @throws APIException
     */
    public function list(
        array|CustomerListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

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
    ): BaseResponse;
}
