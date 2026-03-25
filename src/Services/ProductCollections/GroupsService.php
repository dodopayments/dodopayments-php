<?php

declare(strict_types=1);

namespace Dodopayments\Services\ProductCollections;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\ProductCollections\Groups\GroupCreateParams\Product;
use Dodopayments\ProductCollections\Groups\GroupNewResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\ProductCollections\GroupsContract;
use Dodopayments\Services\ProductCollections\Groups\ItemsService;

/**
 * @phpstan-import-type ProductShape from \Dodopayments\ProductCollections\Groups\GroupCreateParams\Product
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class GroupsService implements GroupsContract
{
    /**
     * @api
     */
    public GroupsRawService $raw;

    /**
     * @api
     */
    public ItemsService $items;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new GroupsRawService($client);
        $this->items = new ItemsService($client);
    }

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
    ): GroupNewResponse {
        $params = Util::removeNulls(
            ['products' => $products, 'groupName' => $groupName, 'status' => $status]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

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
    ): mixed {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'groupName' => $groupName,
                'productOrder' => $productOrder,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($groupID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

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
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($groupID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
