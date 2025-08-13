<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\Brands\Brand;
use Dodopayments\Brands\BrandCreateParams;
use Dodopayments\Brands\BrandUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Brands\BrandListResponse;
use Dodopayments\Responses\Brands\BrandUpdateImagesResponse;

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
