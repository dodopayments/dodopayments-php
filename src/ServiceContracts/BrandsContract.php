<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Brands\Brand;
use Dodopayments\Brands\BrandListResponse;
use Dodopayments\Brands\BrandUpdateImagesResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface BrandsContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?string $description = null,
        ?string $name = null,
        ?string $statementDescriptor = null,
        ?string $supportEmail = null,
        ?string $url = null,
        RequestOptions|array|null $requestOptions = null,
    ): Brand;

    /**
     * @api
     *
     * @param string $id Brand Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): Brand;

    /**
     * @api
     *
     * @param string $id Brand Id
     * @param string|null $imageID The UUID you got back from the presigned‐upload call
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $imageID = null,
        ?string $name = null,
        ?string $statementDescriptor = null,
        ?string $supportEmail = null,
        RequestOptions|array|null $requestOptions = null,
    ): Brand;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BrandListResponse;

    /**
     * @api
     *
     * @param string $id Brand Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BrandUpdateImagesResponse;
}
