<?php

declare(strict_types=1);

namespace DodopaymentsClient\Contracts;

use DodopaymentsClient\Brands\Brand;
use DodopaymentsClient\Brands\BrandCreateParams;
use DodopaymentsClient\Brands\BrandUpdateParams;
use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\Responses\Brands\BrandListResponse;
use DodopaymentsClient\Responses\Brands\BrandUpdateImagesResponse;

interface BrandsContract
{
    /**
     * @param array{
     *   description?: null|string,
     *   name?: null|string,
     *   statementDescriptor?: null|string,
     *   supportEmail?: null|string,
     *   url?: null|string,
     * }|BrandCreateParams $params
     */
    public function create(
        array|BrandCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): Brand;

    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): Brand;

    /**
     * @param array{
     *   imageID?: null|string,
     *   name?: null|string,
     *   statementDescriptor?: null|string,
     *   supportEmail?: null|string,
     * }|BrandUpdateParams $params
     */
    public function update(
        string $id,
        array|BrandUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Brand;

    public function list(
        ?RequestOptions $requestOptions = null
    ): BrandListResponse;

    public function updateImages(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BrandUpdateImagesResponse;
}
