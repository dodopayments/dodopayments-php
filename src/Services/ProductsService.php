<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
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
use Dodopayments\ServiceContracts\ProductsContract;
use Dodopayments\Services\Products\ImagesService;
use Dodopayments\Subscriptions\TimeInterval;

final class ProductsService implements ProductsContract
{
    /**
     * @api
     */
    public ImagesService $images;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->images = new ImagesService($client);
    }

    /**
     * @api
     *
     * @param array{
     *   name: string,
     *   price: Price|array<string,mixed>,
     *   tax_category: 'digital_products'|'saas'|'e_book'|'edtech'|TaxCategory,
     *   addons?: list<string>|null,
     *   brand_id?: string|null,
     *   description?: string|null,
     *   digital_product_delivery?: array{
     *     external_url?: string|null, instructions?: string|null
     *   }|null,
     *   license_key_activation_message?: string|null,
     *   license_key_activations_limit?: int|null,
     *   license_key_duration?: array{
     *     count: int, interval: 'Day'|'Week'|'Month'|'Year'|TimeInterval
     *   }|LicenseKeyDuration|null,
     *   license_key_enabled?: bool|null,
     *   metadata?: array<string,string>,
     * }|ProductCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|ProductCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): Product {
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
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): Product {
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
     *   brand_id?: string|null,
     *   description?: string|null,
     *   digital_product_delivery?: array{
     *     external_url?: string|null,
     *     files?: list<string>|null,
     *     instructions?: string|null,
     *   }|null,
     *   image_id?: string|null,
     *   license_key_activation_message?: string|null,
     *   license_key_activations_limit?: int|null,
     *   license_key_duration?: array{
     *     count: int, interval: 'Day'|'Week'|'Month'|'Year'|TimeInterval
     *   }|LicenseKeyDuration|null,
     *   license_key_enabled?: bool|null,
     *   metadata?: array<string,string>|null,
     *   name?: string|null,
     *   price?: Price|array<string,mixed>|null,
     *   tax_category?: 'digital_products'|'saas'|'e_book'|'edtech'|TaxCategory|null,
     * }|ProductUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|ProductUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
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
     *   brand_id?: string,
     *   page_number?: int,
     *   page_size?: int,
     *   recurring?: bool,
     * }|ProductListParams $params
     *
     * @return DefaultPageNumberPagination<ProductListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|ProductListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = ProductListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'products',
            query: $parsed,
            options: $options,
            convert: ProductListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
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
     * @throws APIException
     */
    public function unarchive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
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
     * @param array{file_name: string}|ProductUpdateFilesParams $params
     *
     * @throws APIException
     */
    public function updateFiles(
        string $id,
        array|ProductUpdateFilesParams $params,
        ?RequestOptions $requestOptions = null,
    ): ProductUpdateFilesResponse {
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
