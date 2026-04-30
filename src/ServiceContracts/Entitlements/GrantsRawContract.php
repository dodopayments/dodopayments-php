<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Entitlements;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Entitlements\Grants\GrantListParams;
use Dodopayments\Entitlements\Grants\GrantListResponse;
use Dodopayments\Entitlements\Grants\GrantRevokeParams;
use Dodopayments\Entitlements\Grants\GrantRevokeResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface GrantsRawContract
{
    /**
     * @api
     *
     * @param string $id Entitlement ID
     * @param array<string,mixed>|GrantListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<GrantListResponse>>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        array|GrantListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $grantID Grant ID
     * @param array<string,mixed>|GrantRevokeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GrantRevokeResponse>
     *
     * @throws APIException
     */
    public function revoke(
        string $grantID,
        array|GrantRevokeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
