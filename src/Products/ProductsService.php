<?php

declare(strict_types=1);

namespace DodopaymentsClient\Products;

use DodopaymentsClient\Client;
use DodopaymentsClient\Contracts\ProductsContract;
use DodopaymentsClient\Core\Conversion;
use DodopaymentsClient\Misc\TaxCategory;
use DodopaymentsClient\Products\Images\ImagesService;
use DodopaymentsClient\Products\Price\OneTimePrice;
use DodopaymentsClient\Products\Price\RecurringPrice;
use DodopaymentsClient\Products\ProductCreateParams\DigitalProductDelivery;
use DodopaymentsClient\Products\ProductUpdateParams\DigitalProductDelivery as DigitalProductDelivery1;
use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\Responses\Products\ProductListResponse;
use DodopaymentsClient\Responses\Products\ProductUpdateFilesResponse;

final class ProductsService implements ProductsContract
{
    public ImagesService $images;

    public function __construct(private Client $client)
    {
        $this->images = new ImagesService($this->client);
    }

    /**
     * @param array{
     *   price: OneTimePrice|RecurringPrice,
     *   taxCategory: TaxCategory::*,
     *   addons?: null|list<string>,
     *   brandID?: null|string,
     *   description?: null|string,
     *   digitalProductDelivery?: null|DigitalProductDelivery,
     *   licenseKeyActivationMessage?: null|string,
     *   licenseKeyActivationsLimit?: null|int,
     *   licenseKeyDuration?: LicenseKeyDuration,
     *   licenseKeyEnabled?: null|bool,
     *   metadata?: array<string, string>,
     *   name?: null|string,
     * }|ProductCreateParams $params
     */
    public function create(
        array|ProductCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): Product {
        [$parsed, $options] = ProductCreateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'products',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Product::class, value: $resp);
    }

    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): Product {
        $resp = $this->client->request(
            method: 'get',
            path: ['products/%1$s', $id],
            options: $requestOptions
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Product::class, value: $resp);
    }

    /**
     * @param array{
     *   addons?: null|list<string>,
     *   brandID?: null|string,
     *   description?: null|string,
     *   digitalProductDelivery?: null|DigitalProductDelivery1,
     *   imageID?: null|string,
     *   licenseKeyActivationMessage?: null|string,
     *   licenseKeyActivationsLimit?: null|int,
     *   licenseKeyDuration?: LicenseKeyDuration,
     *   licenseKeyEnabled?: null|bool,
     *   metadata?: null|array<string, string>,
     *   name?: null|string,
     *   price?: OneTimePrice|RecurringPrice,
     *   taxCategory?: TaxCategory::*,
     * }|ProductUpdateParams $params
     */
    public function update(
        string $id,
        array|ProductUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = ProductUpdateParams::parseRequest(
            $params,
            $requestOptions
        );

        return $this->client->request(
            method: 'patch',
            path: ['products/%1$s', $id],
            body: (object) $parsed,
            options: $options,
        );
    }

    /**
     * @param array{
     *   archived?: bool,
     *   brandID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   recurring?: bool,
     * }|ProductListParams $params
     */
    public function list(
        array|ProductListParams $params,
        ?RequestOptions $requestOptions = null
    ): ProductListResponse {
        [$parsed, $options] = ProductListParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'products',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(ProductListResponse::class, value: $resp);
    }

    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        return $this->client->request(
            method: 'delete',
            path: ['products/%1$s', $id],
            options: $requestOptions
        );
    }

    public function unarchive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        return $this->client->request(
            method: 'post',
            path: ['products/%1$s/unarchive', $id],
            options: $requestOptions,
        );
    }

    /**
     * @param array{fileName: string}|ProductUpdateFilesParams $params
     */
    public function updateFiles(
        string $id,
        array|ProductUpdateFilesParams $params,
        ?RequestOptions $requestOptions = null,
    ): ProductUpdateFilesResponse {
        [$parsed, $options] = ProductUpdateFilesParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'put',
            path: ['products/%1$s/files', $id],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(ProductUpdateFilesResponse::class, value: $resp);
    }
}
