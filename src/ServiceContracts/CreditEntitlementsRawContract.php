<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\CreditEntitlements\CreditEntitlement;
use Dodopayments\CreditEntitlements\CreditEntitlementCreateParams;
use Dodopayments\CreditEntitlements\CreditEntitlementListParams;
use Dodopayments\CreditEntitlements\CreditEntitlementUpdateParams;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface CreditEntitlementsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CreditEntitlementCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CreditEntitlement>
     *
     * @throws APIException
     */
    public function create(
        array|CreditEntitlementCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Credit Entitlement ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CreditEntitlement>
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
     * @param string $id Credit Entitlement ID
     * @param array<string,mixed>|CreditEntitlementUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|CreditEntitlementUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|CreditEntitlementListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<CreditEntitlement>>
     *
     * @throws APIException
     */
    public function list(
        array|CreditEntitlementListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Credit Entitlement ID
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

    /**
     * @api
     *
     * @param string $id Credit Entitlement ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function undelete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
