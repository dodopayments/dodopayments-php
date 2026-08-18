<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Brands\Brand;
use Dodopayments\Brands\BrandArchiveParams;
use Dodopayments\Brands\BrandArchiveResponse;
use Dodopayments\Brands\BrandCreateParams;
use Dodopayments\Brands\BrandListParams;
use Dodopayments\Brands\BrandListResponse;
use Dodopayments\Brands\BrandUpdateImagesResponse;
use Dodopayments\Brands\BrandUpdateParams;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface BrandsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|BrandCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Brand>
     *
     * @throws APIException
     */
    public function create(
        array|BrandCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Brand Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Brand>
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
     * @param string $id Brand Id
     * @param array<string,mixed>|BrandUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Brand>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|BrandUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BrandListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|BrandListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Brand Id
     * @param array<string,mixed>|BrandArchiveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandArchiveResponse>
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        array|BrandArchiveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Brand Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandUpdateImagesResponse>
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
