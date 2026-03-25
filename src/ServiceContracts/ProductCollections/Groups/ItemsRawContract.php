<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\ProductCollections\Groups;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\ProductCollections\Groups\Items\ItemCreateParams;
use Dodopayments\ProductCollections\Groups\Items\ItemDeleteParams;
use Dodopayments\ProductCollections\Groups\Items\ItemNewResponseItem;
use Dodopayments\ProductCollections\Groups\Items\ItemUpdateParams;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface ItemsRawContract
{
    /**
     * @api
     *
     * @param string $groupID Path param: Product Collection Group Id
     * @param array<string,mixed>|ItemCreateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $itemID Path param: Collection item Id (product membership in group)
     * @param array<string,mixed>|ItemUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $itemID Collection item Id (product membership in group)
     * @param array<string,mixed>|ItemDeleteParams $params
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
    ): BaseResponse;
}
