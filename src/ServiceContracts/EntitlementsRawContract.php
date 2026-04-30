<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Entitlements\EntitlementCreateParams;
use Dodopayments\Entitlements\EntitlementGetResponse;
use Dodopayments\Entitlements\EntitlementListParams;
use Dodopayments\Entitlements\EntitlementListResponse;
use Dodopayments\Entitlements\EntitlementNewResponse;
use Dodopayments\Entitlements\EntitlementUpdateParams;
use Dodopayments\Entitlements\EntitlementUpdateResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface EntitlementsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|EntitlementCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntitlementNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|EntitlementCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Entitlement ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntitlementGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Entitlement ID
     * @param array<string,mixed>|EntitlementUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntitlementUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|EntitlementUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|EntitlementListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<EntitlementListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|EntitlementListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Entitlement ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
