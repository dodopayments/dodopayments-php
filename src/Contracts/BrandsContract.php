<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\Brands\Brand;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Brands\BrandListResponse;
use Dodopayments\Responses\Brands\BrandUpdateImagesResponse;

interface BrandsContract
{
    /**
     * @param string|null $description
     * @param string|null $name
     * @param string|null $statementDescriptor
     * @param string|null $supportEmail
     * @param string|null $url
     */
    public function create(
        $description = null,
        $name = null,
        $statementDescriptor = null,
        $supportEmail = null,
        $url = null,
        ?RequestOptions $requestOptions = null,
    ): Brand;

    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): Brand;

    /**
     * @param string|null $imageID The UUID you got back from the presigned‐upload call
     * @param string|null $name
     * @param string|null $statementDescriptor
     * @param string|null $supportEmail
     */
    public function update(
        string $id,
        $imageID = null,
        $name = null,
        $statementDescriptor = null,
        $supportEmail = null,
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
