<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Brands\Brand;
use Dodopayments\Brands\BrandListResponse;
use Dodopayments\Brands\BrandUpdateImagesResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

interface BrandsContract
{
    /**
     * @api
     *
     * @param string|null $description
     * @param string|null $name
     * @param string|null $statementDescriptor
     * @param string|null $supportEmail
     * @param string|null $url
     *
     * @throws APIException
     */
    public function create(
        $description = omit,
        $name = omit,
        $statementDescriptor = omit,
        $supportEmail = omit,
        $url = omit,
        ?RequestOptions $requestOptions = null,
    ): Brand;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
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
     * @param string|null $imageID The UUID you got back from the presigned‐upload call
     * @param string|null $name
     * @param string|null $statementDescriptor
     * @param string|null $supportEmail
     *
     * @throws APIException
     */
    public function update(
        string $id,
        $imageID = omit,
        $name = omit,
        $statementDescriptor = omit,
        $supportEmail = omit,
        ?RequestOptions $requestOptions = null,
    ): Brand;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $id,
        array $params,
        ?RequestOptions $requestOptions = null
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
