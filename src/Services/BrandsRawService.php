<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Brands\Brand;
use Dodopayments\Brands\BrandCreateParams;
use Dodopayments\Brands\BrandListResponse;
use Dodopayments\Brands\BrandUpdateImagesResponse;
use Dodopayments\Brands\BrandUpdateParams;
use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\BrandsRawContract;

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
     *
     * @return BaseResponse<Brand>
     *
     * @throws APIException
     */
    public function create(
        array|BrandCreateParams $params,
        ?RequestOptions $requestOptions = null
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
     *
     * @return BaseResponse<Brand>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
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
     *   imageID?: string|null,
     *   name?: string|null,
     *   statementDescriptor?: string|null,
     *   supportEmail?: string|null,
     * }|BrandUpdateParams $params
     *
     * @return BaseResponse<Brand>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|BrandUpdateParams $params,
        ?RequestOptions $requestOptions = null,
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
     * @return BaseResponse<BrandListResponse>
     *
     * @throws APIException
     */
    public function list(?RequestOptions $requestOptions = null): BaseResponse
    {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'brands',
            options: $requestOptions,
            convert: BrandListResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Brand Id
     *
     * @return BaseResponse<BrandUpdateImagesResponse>
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        ?RequestOptions $requestOptions = null
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
