<?php

declare(strict_types=1);

namespace Dodopayments\Services\ProductCollections;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\ProductCollections\Groups\GroupCreateParams;
use Dodopayments\ProductCollections\Groups\GroupCreateParams\Product;
use Dodopayments\ProductCollections\Groups\GroupDeleteParams;
use Dodopayments\ProductCollections\Groups\GroupNewResponse;
use Dodopayments\ProductCollections\Groups\GroupUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\ProductCollections\GroupsRawContract;

/**
 * @phpstan-import-type ProductShape from \Dodopayments\ProductCollections\Groups\GroupCreateParams\Product
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class GroupsRawService implements GroupsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param array{
     *   products: list<Product|ProductShape>,
     *   groupName?: string|null,
     *   status?: bool|null,
     * }|GroupCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GroupNewResponse>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|GroupCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = GroupCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['product-collections/%1$s/groups', $id],
            body: (object) $parsed,
            options: $options,
            convert: GroupNewResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $groupID Path param: Product Collection Group Id
     * @param array{
     *   id: string,
     *   groupName?: string|null,
     *   productOrder?: list<string>|null,
     *   status?: bool|null,
     * }|GroupUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $groupID,
        array|GroupUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = GroupUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['product-collections/%1$s/groups/%2$s', $id, $groupID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * @param string $groupID Product Collection Group Id
     * @param array{id: string}|GroupDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $groupID,
        array|GroupDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = GroupDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['product-collections/%1$s/groups/%2$s', $id, $groupID],
            options: $options,
            convert: null,
        );
    }
}
