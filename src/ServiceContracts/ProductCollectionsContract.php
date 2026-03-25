<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\ProductCollections\ProductCollectionCreateParams\Group;
use Dodopayments\ProductCollections\ProductCollectionGetResponse;
use Dodopayments\ProductCollections\ProductCollectionListResponse;
use Dodopayments\ProductCollections\ProductCollectionNewResponse;
use Dodopayments\ProductCollections\ProductCollectionUnarchiveResponse;
use Dodopayments\ProductCollections\ProductCollectionUpdateImagesResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type GroupShape from \Dodopayments\ProductCollections\ProductCollectionCreateParams\Group
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface ProductCollectionsContract
{
    /**
     * @api
     *
     * @param list<Group|GroupShape> $groups Groups of products in this collection
     * @param string $name Name of the product collection
     * @param string|null $brandID Brand id for the collection, if not provided will default to primary brand
     * @param string|null $description Optional description of the product collection
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        array $groups,
        string $name,
        ?string $brandID = null,
        ?string $description = null,
        RequestOptions|array|null $requestOptions = null,
    ): ProductCollectionNewResponse;

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ProductCollectionGetResponse;

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param string|null $brandID Optional brand_id update
     * @param string|null $description Optional description update - pass null to remove, omit to keep unchanged
     * @param list<string>|null $groupOrder Optional new order for groups (array of group UUIDs in desired order)
     * @param string|null $imageID Optional image update - pass null to remove, omit to keep unchanged
     * @param string|null $name Optional new name for the collection
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $brandID = null,
        ?string $description = null,
        ?array $groupOrder = null,
        ?string $imageID = null,
        ?string $name = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param bool $archived List archived collections
     * @param string $brandID Filter by Brand id
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<ProductCollectionListResponse>
     *
     * @throws APIException
     */
    public function list(
        ?bool $archived = null,
        ?string $brandID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function unarchive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ProductCollectionUnarchiveResponse;

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param bool|null $forceUpdate If true, generates a new image ID to force cache invalidation
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        ?bool $forceUpdate = null,
        RequestOptions|array|null $requestOptions = null,
    ): ProductCollectionUpdateImagesResponse;
}
