<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Brands\Brand;
use Dodopayments\Brands\BrandCreateParams;
use Dodopayments\Brands\BrandListResponse;
use Dodopayments\Brands\BrandUpdateImagesResponse;
use Dodopayments\Brands\BrandUpdateParams;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;

interface BrandsContract
{
    /**
     * @api
     *
     * @param array<mixed>|BrandCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|BrandCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): Brand;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): Brand;

    /**
     * @api
     *
     * @param array<mixed>|BrandUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|BrandUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Brand;

    /**
     * @api
     *
     * @throws APIException
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): BrandListResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BrandUpdateImagesResponse;
}
