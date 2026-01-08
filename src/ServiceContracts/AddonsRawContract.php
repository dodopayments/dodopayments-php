<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Addons\AddonCreateParams;
use Dodopayments\Addons\AddonListParams;
use Dodopayments\Addons\AddonResponse;
use Dodopayments\Addons\AddonUpdateImagesResponse;
use Dodopayments\Addons\AddonUpdateParams;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface AddonsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AddonCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AddonResponse>
     *
     * @throws APIException
     */
    public function create(
        array|AddonCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Addon Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AddonResponse>
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
     * @param string $id Addon Id
     * @param array<string,mixed>|AddonUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AddonResponse>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|AddonUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|AddonListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<AddonResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|AddonListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Addon Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AddonUpdateImagesResponse>
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
