<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Brands\Brand;
use Dodopayments\Brands\BrandArchiveResponse;
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
        ?string $description = null,
        ?string $imageID = null,
        ?string $name = null,
        ?string $statementDescriptor = null,
        ?string $supportEmail = null,
        ?string $url = null,
        RequestOptions|array|null $requestOptions = null,
    ): Brand;

    /**
     * @api
     *
     * @param bool $includeArchived Set to true to also list archived brands. Default false.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?bool $includeArchived = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandListResponse;

    /**
     * @api
     *
     * @param string $id Brand Id
     * @param string|null $moveProductsTo Brand that takes over the products and the live subscriptions of the
     * brand you archive. It must be a brand of the same business, and it must
     * not be archived. The primary brand (its brand id is the business id) is
     * a valid target. Omit this field only when the brand holds no products
     * and no live subscriptions.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        ?string $moveProductsTo = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandArchiveResponse;

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
