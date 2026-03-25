<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\ProductCollections;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\ProductCollections\Groups\GroupCreateParams\Product;
use Dodopayments\ProductCollections\Groups\GroupNewResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type ProductShape from \Dodopayments\ProductCollections\Groups\GroupCreateParams\Product
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface GroupsContract
{
    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param list<Product|ProductShape> $products Products in this group
     * @param string|null $groupName Optional group name. Multiple groups can have null names, but named groups must be unique per collection
     * @param bool|null $status Status of the group (defaults to true if not provided)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array $products,
        ?string $groupName = null,
        ?bool $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): GroupNewResponse;

    /**
     * @api
     *
     * @param string $groupID Path param: Product Collection Group Id
     * @param string $id Path param: Product Collection Id
     * @param string|null $groupName Body param: Optional group name update: Some(Some(name)) = set name, Some(None) = clear name, None = no change
     * @param list<string>|null $productOrder Body param: Optional new order for products in this group (array of product_collection_group_pdts UUIDs)
     * @param bool|null $status Body param: Optional status update
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $groupID,
        string $id,
        ?string $groupName = null,
        ?array $productOrder = null,
        ?bool $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $groupID Product Collection Group Id
     * @param string $id Product Collection Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $groupID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
