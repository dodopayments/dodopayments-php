<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\ProductCollections\Groups;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\ProductCollections\Groups\GroupProduct;
use Dodopayments\ProductCollections\Groups\Items\ProductCollectionProduct;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type GroupProductShape from \Dodopayments\ProductCollections\Groups\GroupProduct
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface ItemsContract
{
    /**
     * @api
     *
     * @param string $groupID Path param: Product Collection Group Id
     * @param string $id Path param: Product Collection Id
     * @param list<GroupProduct|GroupProductShape> $products Body param: Products to add to the group
     * @param RequestOpts|null $requestOptions
     *
     * @return list<ProductCollectionProduct>
     *
     * @throws APIException
     */
    public function create(
        string $groupID,
        string $id,
        array $products,
        RequestOptions|array|null $requestOptions = null,
    ): array;

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
    ): mixed;

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
    ): mixed;
}
