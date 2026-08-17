<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Brands\Brand;
use Dodopayments\Brands\BrandArchiveParams;
use Dodopayments\Brands\BrandArchiveResponse;
use Dodopayments\Brands\BrandCreateParams;
use Dodopayments\Brands\BrandListParams;
use Dodopayments\Brands\BrandListResponse;
use Dodopayments\Brands\BrandUpdateImagesResponse;
use Dodopayments\Brands\BrandUpdateParams;
use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\BrandsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class BrandsRawService implements BrandsRawContract
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
     *   description?: string|null,
     *   name?: string|null,
     *   statementDescriptor?: string|null,
     *   supportEmail?: string|null,
     *   url?: string|null,
     * }|BrandCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Brand>
     *
     * @throws APIException
     */
    public function create(
        array|BrandCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BrandCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'brands',
            body: (object) $parsed,
            options: $options,
            convert: Brand::class,
        );
    }

    /**
     * @api
     *
     * Thin handler just calls `get_brand` and wraps in `Json(...)`
     *
     * @param string $id Brand Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Brand>
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
            path: ['brands/%1$s', $id],
            options: $requestOptions,
            convert: Brand::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Brand Id
     * @param array{
     *   description?: string|null,
     *   imageID?: string|null,
     *   name?: string|null,
     *   statementDescriptor?: string|null,
     *   supportEmail?: string|null,
     *   url?: string|null,
     * }|BrandUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Brand>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|BrandUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BrandUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['brands/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: Brand::class,
        );
    }

    /**
     * @api
     *
     * @param array{includeArchived?: bool}|BrandListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|BrandListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BrandListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'brands',
            query: Util::array_transform_keys(
                $parsed,
                ['includeArchived' => 'include_archived']
            ),
            options: $options,
            convert: BrandListResponse::class,
        );
    }

    /**
     * @api
     *
     * Archive a brand. Its products, live subscriptions, and product collections
     * move to the `move_products_to` brand. Archive is permanent.
     *
     * @param string $id Brand Id
     * @param array{moveProductsTo?: string|null}|BrandArchiveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandArchiveResponse>
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        array|BrandArchiveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BrandArchiveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['brands/%1$s/archive', $id],
            body: (object) $parsed,
            options: $options,
            convert: BrandArchiveResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Brand Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BrandUpdateImagesResponse>
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['brands/%1$s/images', $id],
            options: $requestOptions,
            convert: BrandUpdateImagesResponse::class,
        );
    }
}
