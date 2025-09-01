<?php

declare(strict_types=1);

namespace Dodopayments\Core\Services;

use Dodopayments\Client;
use Dodopayments\Core\ServiceContracts\ProductsContract;
use Dodopayments\Core\Services\Products\ImagesService;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\LicenseKeyDuration;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\RecurringPrice;
use Dodopayments\Products\Price\UsageBasedPrice;
use Dodopayments\Products\Product;
use Dodopayments\Products\ProductCreateParams;
use Dodopayments\Products\ProductCreateParams\DigitalProductDelivery;
use Dodopayments\Products\ProductListParams;
use Dodopayments\Products\ProductListResponse;
use Dodopayments\Products\ProductUpdateFilesParams;
use Dodopayments\Products\ProductUpdateFilesResponse;
use Dodopayments\Products\ProductUpdateParams;
use Dodopayments\Products\ProductUpdateParams\DigitalProductDelivery as DigitalProductDelivery1;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

final class ProductsService implements ProductsContract
{
    /**
     * @@api
     */
    public ImagesService $images;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->images = new ImagesService($this->client);
    }

    /**
     * @api
     *
     * @param OneTimePrice|RecurringPrice|UsageBasedPrice $price Price configuration for the product
     * @param TaxCategory::* $taxCategory Tax category applied to this product
     * @param list<string>|null $addons Addons available for subscription product
     * @param string|null $brandID Brand id for the product, if not provided will default to primary brand
     * @param string|null $description Optional description of the product
     * @param DigitalProductDelivery|null $digitalProductDelivery Choose how you would like you digital product delivered
     * @param string|null $licenseKeyActivationMessage Optional message displayed during license key activation
     * @param int|null $licenseKeyActivationsLimit The number of times the license key can be activated.
     * Must be 0 or greater
     * @param LicenseKeyDuration $licenseKeyDuration Duration configuration for the license key.
     * Set to null if you don't want the license key to expire.
     * For subscriptions, the lifetime of the license key is tied to the subscription period
     * @param bool|null $licenseKeyEnabled When true, generates and sends a license key to your customer.
     * Defaults to false
     * @param array<string, string> $metadata Additional metadata for the product
     * @param string|null $name Optional name of the product
     */
    public function create(
        $price,
        $taxCategory,
        $addons = omit,
        $brandID = omit,
        $description = omit,
        $digitalProductDelivery = omit,
        $licenseKeyActivationMessage = omit,
        $licenseKeyActivationsLimit = omit,
        $licenseKeyDuration = omit,
        $licenseKeyEnabled = omit,
        $metadata = omit,
        $name = omit,
        ?RequestOptions $requestOptions = null,
    ): Product {
        [$parsed, $options] = ProductCreateParams::parseRequest(
            [
                'price' => $price,
                'taxCategory' => $taxCategory,
                'addons' => $addons,
                'brandID' => $brandID,
                'description' => $description,
                'digitalProductDelivery' => $digitalProductDelivery,
                'licenseKeyActivationMessage' => $licenseKeyActivationMessage,
                'licenseKeyActivationsLimit' => $licenseKeyActivationsLimit,
                'licenseKeyDuration' => $licenseKeyDuration,
                'licenseKeyEnabled' => $licenseKeyEnabled,
                'metadata' => $metadata,
                'name' => $name,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
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
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): Product {
        // @phpstan-ignore-next-line;
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
     * @param list<string>|null $addons Available Addons for subscription products
     * @param string|null $brandID
     * @param string|null $description description of the product, optional and must be at most 1000 characters
     * @param DigitalProductDelivery1|null $digitalProductDelivery Choose how you would like you digital product delivered
     * @param string|null $imageID Product image id after its uploaded to S3
     * @param string|null $licenseKeyActivationMessage Message sent to the customer upon license key activation.
     *
     * Only applicable if `license_key_enabled` is `true`. This message contains instructions for
     * activating the license key.
     * @param int|null $licenseKeyActivationsLimit Limit for the number of activations for the license key.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the maximum number of times
     * the license key can be activated.
     * @param LicenseKeyDuration $licenseKeyDuration Duration of the license key if enabled.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the duration in days for which
     * the license key is valid.
     * @param bool|null $licenseKeyEnabled Whether the product requires a license key.
     *
     * If `true`, additional fields related to license key (duration, activations limit, activation message)
     * become applicable.
     * @param array<string, string>|null $metadata Additional metadata for the product
     * @param string|null $name name of the product, optional and must be at most 100 characters
     * @param OneTimePrice|RecurringPrice|UsageBasedPrice $price price details of the product
     * @param TaxCategory::* $taxCategory tax category of the product
     */
    public function update(
        string $id,
        $addons = omit,
        $brandID = omit,
        $description = omit,
        $digitalProductDelivery = omit,
        $imageID = omit,
        $licenseKeyActivationMessage = omit,
        $licenseKeyActivationsLimit = omit,
        $licenseKeyDuration = omit,
        $licenseKeyEnabled = omit,
        $metadata = omit,
        $name = omit,
        $price = omit,
        $taxCategory = omit,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = ProductUpdateParams::parseRequest(
            [
                'addons' => $addons,
                'brandID' => $brandID,
                'description' => $description,
                'digitalProductDelivery' => $digitalProductDelivery,
                'imageID' => $imageID,
                'licenseKeyActivationMessage' => $licenseKeyActivationMessage,
                'licenseKeyActivationsLimit' => $licenseKeyActivationsLimit,
                'licenseKeyDuration' => $licenseKeyDuration,
                'licenseKeyEnabled' => $licenseKeyEnabled,
                'metadata' => $metadata,
                'name' => $name,
                'price' => $price,
                'taxCategory' => $taxCategory,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
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
     * @param bool $archived List archived products
     * @param string $brandID filter by Brand id
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param bool $recurring Filter products by pricing type:
     * - `true`: Show only recurring pricing products (e.g. subscriptions)
     * - `false`: Show only one-time price products
     * - `null` or absent: Show both types of products
     *
     * @return DefaultPageNumberPagination<ProductListResponse>
     */
    public function list(
        $archived = omit,
        $brandID = omit,
        $pageNumber = omit,
        $pageSize = omit,
        $recurring = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        [$parsed, $options] = ProductListParams::parseRequest(
            [
                'archived' => $archived,
                'brandID' => $brandID,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'recurring' => $recurring,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
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
     */
    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['products/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     */
    public function unarchive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line;
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
     * @param string $fileName
     */
    public function updateFiles(
        string $id,
        $fileName,
        ?RequestOptions $requestOptions = null
    ): ProductUpdateFilesResponse {
        [$parsed, $options] = ProductUpdateFilesParams::parseRequest(
            ['fileName' => $fileName],
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['products/%1$s/files', $id],
            body: (object) $parsed,
            options: $options,
            convert: ProductUpdateFilesResponse::class,
        );
    }
}
