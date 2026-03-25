<?php

declare(strict_types=1);

namespace Dodopayments\Services\ProductCollections\Groups;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\ProductCollections\Groups\Items\ItemCreateParams\Product;
use Dodopayments\ProductCollections\Groups\Items\ItemNewResponseItem;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\ProductCollections\Groups\ItemsContract;

/**
 * @phpstan-import-type ProductShape from \Dodopayments\ProductCollections\Groups\Items\ItemCreateParams\Product
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class ItemsService implements ItemsContract
{
    /**
     * @api
     */
    public ItemsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ItemsRawService($client);
    }

    /**
     * @api
     *
     * @param string $groupID Path param: Product Collection Group Id
     * @param string $id Path param: Product Collection Id
     * @param list<Product|ProductShape> $products Body param: Products to add to the group
     * @param RequestOpts|null $requestOptions
     *
     * @return list<ItemNewResponseItem>
     *
     * @throws APIException
     */
    public function create(
        string $groupID,
        string $id,
        array $products,
        RequestOptions|array|null $requestOptions = null,
    ): array {
        $params = Util::removeNulls(['id' => $id, 'products' => $products]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($groupID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $itemID Path param: Collection item Id (product membership in group)
     * @param string $id Path param: Product Collection Id
     * @param string $groupID Path param: Product Collection Group Id
     * @param bool $status Body param: Status of the product in the group
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $itemID,
        string $id,
        string $groupID,
        bool $status,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            ['id' => $id, 'groupID' => $groupID, 'status' => $status]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($itemID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $itemID Collection item Id (product membership in group)
     * @param string $id Product Collection Id
     * @param string $groupID Product Collection Group Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $itemID,
        string $id,
        string $groupID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['id' => $id, 'groupID' => $groupID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($itemID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
