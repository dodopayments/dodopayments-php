<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\ProductCollections\ProductCollectionCreateParams;
use Dodopayments\ProductCollections\ProductCollectionCreateParams\Group;
use Dodopayments\ProductCollections\ProductCollectionGetResponse;
use Dodopayments\ProductCollections\ProductCollectionListParams;
use Dodopayments\ProductCollections\ProductCollectionListResponse;
use Dodopayments\ProductCollections\ProductCollectionNewResponse;
use Dodopayments\ProductCollections\ProductCollectionUnarchiveResponse;
use Dodopayments\ProductCollections\ProductCollectionUpdateImagesParams;
use Dodopayments\ProductCollections\ProductCollectionUpdateImagesResponse;
use Dodopayments\ProductCollections\ProductCollectionUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\ProductCollectionsRawContract;

/**
 * @phpstan-import-type GroupShape from \Dodopayments\ProductCollections\ProductCollectionCreateParams\Group
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class ProductCollectionsRawService implements ProductCollectionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{
     *   groups: list<Group|GroupShape>,
     *   name: string,
     *   brandID?: string|null,
     *   description?: string|null,
     * }|ProductCollectionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProductCollectionNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|ProductCollectionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProductCollectionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'product-collections',
            body: (object) $parsed,
            options: $options,
            convert: ProductCollectionNewResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProductCollectionGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['product-collections/%1$s', $id],
            options: $requestOptions,
            convert: ProductCollectionGetResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param array{
     *   brandID?: string|null,
     *   description?: string|null,
     *   groupOrder?: list<string>|null,
     *   imageID?: string|null,
     *   name?: string|null,
     * }|ProductCollectionUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|ProductCollectionUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProductCollectionUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['product-collections/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   archived?: bool, brandID?: string, pageNumber?: int, pageSize?: int
     * }|ProductCollectionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<ProductCollectionListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|ProductCollectionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProductCollectionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'product-collections',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'brandID' => 'brand_id',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                ],
            ),
            options: $options,
            convert: ProductCollectionListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['product-collections/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProductCollectionUnarchiveResponse>
     *
     * @throws APIException
     */
    public function unarchive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['product-collections/%1$s/unarchive', $id],
            options: $requestOptions,
            convert: ProductCollectionUnarchiveResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param array{
     *   forceUpdate?: bool|null
     * }|ProductCollectionUpdateImagesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProductCollectionUpdateImagesResponse>
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        array|ProductCollectionUpdateImagesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProductCollectionUpdateImagesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['product-collections/%1$s/images', $id],
            query: Util::array_transform_keys(
                $parsed,
                ['forceUpdate' => 'force_update']
            ),
            options: $options,
            convert: ProductCollectionUpdateImagesResponse::class,
        );
    }
}
