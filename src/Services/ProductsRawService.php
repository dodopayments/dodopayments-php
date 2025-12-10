<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\LicenseKeyDuration;
use Dodopayments\Products\Price;
use Dodopayments\Products\Product;
use Dodopayments\Products\ProductCreateParams;
use Dodopayments\Products\ProductListParams;
use Dodopayments\Products\ProductListResponse;
use Dodopayments\Products\ProductUpdateFilesParams;
use Dodopayments\Products\ProductUpdateFilesResponse;
use Dodopayments\Products\ProductUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\ProductsRawContract;
use Dodopayments\Subscriptions\TimeInterval;

final class ProductsRawService implements ProductsRawContract
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
     *   name: string,
     *   price: Price|array<string,mixed>,
     *   taxCategory: 'digital_products'|'saas'|'e_book'|'edtech'|TaxCategory,
     *   addons?: list<string>|null,
     *   brandID?: string|null,
     *   description?: string|null,
     *   digitalProductDelivery?: array{
     *     externalURL?: string|null, instructions?: string|null
     *   }|null,
     *   licenseKeyActivationMessage?: string|null,
     *   licenseKeyActivationsLimit?: int|null,
     *   licenseKeyDuration?: array{
     *     count: int, interval: 'Day'|'Week'|'Month'|'Year'|TimeInterval
     *   }|LicenseKeyDuration|null,
     *   licenseKeyEnabled?: bool|null,
     *   metadata?: array<string,string>,
     * }|ProductCreateParams $params
     *
     * @return BaseResponse<Product>
     *
     * @throws APIException
     */
    public function create(
        array|ProductCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = ProductCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'products',
            body: (object) $parsed,
            options: $options,
            convert: Product::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Product Id
     *
     * @return BaseResponse<Product>
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
            path: ['products/%1$s', $id],
            options: $requestOptions,
            convert: Product::class,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   addons?: list<string>|null,
     *   brandID?: string|null,
     *   description?: string|null,
     *   digitalProductDelivery?: array{
     *     externalURL?: string|null,
     *     files?: list<string>|null,
     *     instructions?: string|null,
     *   }|null,
     *   imageID?: string|null,
     *   licenseKeyActivationMessage?: string|null,
     *   licenseKeyActivationsLimit?: int|null,
     *   licenseKeyDuration?: array{
     *     count: int, interval: 'Day'|'Week'|'Month'|'Year'|TimeInterval
     *   }|LicenseKeyDuration|null,
     *   licenseKeyEnabled?: bool|null,
     *   metadata?: array<string,string>|null,
     *   name?: string|null,
     *   price?: Price|array<string,mixed>|null,
     *   taxCategory?: 'digital_products'|'saas'|'e_book'|'edtech'|TaxCategory|null,
     * }|ProductUpdateParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|ProductUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProductUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['products/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   archived?: bool,
     *   brandID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   recurring?: bool,
     * }|ProductListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<ProductListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|ProductListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = ProductListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'products',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'brandID' => 'brand_id',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                ],
            ),
            options: $options,
            convert: ProductListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['products/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function unarchive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['products/%1$s/unarchive', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * @param string $id Product Id
     * @param array{fileName: string}|ProductUpdateFilesParams $params
     *
     * @return BaseResponse<ProductUpdateFilesResponse>
     *
     * @throws APIException
     */
    public function updateFiles(
        string $id,
        array|ProductUpdateFilesParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProductUpdateFilesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['products/%1$s/files', $id],
            body: (object) $parsed,
            options: $options,
            convert: ProductUpdateFilesResponse::class,
        );
    }
}
