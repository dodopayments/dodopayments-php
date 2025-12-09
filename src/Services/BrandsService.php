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
use Dodopayments\ServiceContracts\BrandsContract;

final class BrandsService implements BrandsContract
{
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
     * @throws APIException
     */
    public function create(
        array|BrandCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): Brand {
        [$parsed, $options] = BrandCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<Brand> */
        $response = $this->client->request(
            method: 'post',
            path: 'brands',
            body: (object) $parsed,
            options: $options,
            convert: Brand::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Thin handler just calls `get_brand` and wraps in `Json(...)`
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): Brand {
        /** @var BaseResponse<Brand> */
        $response = $this->client->request(
            method: 'get',
            path: ['brands/%1$s', $id],
            options: $requestOptions,
            convert: Brand::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{
     *   imageID?: string|null,
     *   name?: string|null,
     *   statementDescriptor?: string|null,
     *   supportEmail?: string|null,
     * }|BrandUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|BrandUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Brand {
        [$parsed, $options] = BrandUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<Brand> */
        $response = $this->client->request(
            method: 'patch',
            path: ['brands/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: Brand::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): BrandListResponse {
        /** @var BaseResponse<BrandListResponse> */
        $response = $this->client->request(
            method: 'get',
            path: 'brands',
            options: $requestOptions,
            convert: BrandListResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BrandUpdateImagesResponse {
        /** @var BaseResponse<BrandUpdateImagesResponse> */
        $response = $this->client->request(
            method: 'put',
            path: ['brands/%1$s/images', $id],
            options: $requestOptions,
            convert: BrandUpdateImagesResponse::class,
        );

        return $response->parse();
    }
}
