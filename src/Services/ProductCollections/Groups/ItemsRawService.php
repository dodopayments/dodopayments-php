<?php

declare(strict_types=1);

namespace Dodopayments\Services\ProductCollections\Groups;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\ProductCollections\Groups\Items\ItemCreateParams;
use Dodopayments\ProductCollections\Groups\Items\ItemCreateParams\Product;
use Dodopayments\ProductCollections\Groups\Items\ItemDeleteParams;
use Dodopayments\ProductCollections\Groups\Items\ItemNewResponseItem;
use Dodopayments\ProductCollections\Groups\Items\ItemUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\ProductCollections\Groups\ItemsRawContract;

/**
 * @phpstan-import-type ProductShape from \Dodopayments\ProductCollections\Groups\Items\ItemCreateParams\Product
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class ItemsRawService implements ItemsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param string $groupID Path param: Product Collection Group Id
     * @param array{
     *   id: string, products: list<Product|ProductShape>
     * }|ItemCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<ItemNewResponseItem>>
     *
     * @throws APIException
     */
    public function create(
        string $groupID,
        array|ItemCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ItemCreateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['product-collections/%1$s/groups/%2$s/items', $id, $groupID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: new ListOf(ItemNewResponseItem::class),
        );
    }

    /**
     * @api
     *
     * @param string $itemID Path param: Collection item Id (product membership in group)
     * @param array{id: string, groupID: string, status: bool}|ItemUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $itemID,
        array|ItemUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ItemUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);
        $groupID = $parsed['groupID'];
        unset($parsed['groupID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: [
                'product-collections/%1$s/groups/%2$s/items/%3$s',
                $id,
                $groupID,
                $itemID,
            ],
            body: (object) array_diff_key($parsed, array_flip(['id', 'groupID'])),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * @param string $itemID Collection item Id (product membership in group)
     * @param array{id: string, groupID: string}|ItemDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $itemID,
        array|ItemDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ItemDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);
        $groupID = $parsed['groupID'];
        unset($parsed['groupID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: [
                'product-collections/%1$s/groups/%2$s/items/%3$s',
                $id,
                $groupID,
                $itemID,
            ],
            options: $options,
            convert: null,
        );
    }
}
