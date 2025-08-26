<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\Brands\Brand;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Brands\BrandListResponse;
use Dodopayments\Responses\Brands\BrandUpdateImagesResponse;

use const Dodopayments\Core\OMIT as omit;

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
        $description = omit,
        $name = omit,
        $statementDescriptor = omit,
        $supportEmail = omit,
        $url = omit,
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
        $imageID = omit,
        $name = omit,
        $statementDescriptor = omit,
        $supportEmail = omit,
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
