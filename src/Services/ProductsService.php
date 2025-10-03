<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Implementation\HasRawResponse;
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
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\ProductsContract;
use Dodopayments\Services\Products\ImagesService;

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
        $this->images = new ImagesService($client);
    }

    /**
     * @api
     *
     * @param OneTimePrice|RecurringPrice|UsageBasedPrice $price Price configuration for the product
     * @param TaxCategory|value-of<TaxCategory> $taxCategory Tax category applied to this product
     * @param list<string>|null $addons Addons available for subscription product
     * @param string|null $brandID Brand id for the product, if not provided will default to primary brand
     * @param string|null $description Optional description of the product
     * @param DigitalProductDelivery|null $digitalProductDelivery Choose how you would like you digital product delivered
     * @param string|null $licenseKeyActivationMessage Optional message displayed during license key activation
     * @param int|null $licenseKeyActivationsLimit The number of times the license key can be activated.
     * Must be 0 or greater
     * @param LicenseKeyDuration|null $licenseKeyDuration Duration configuration for the license key.
     * Set to null if you don't want the license key to expire.
     * For subscriptions, the lifetime of the license key is tied to the subscription period
     * @param bool|null $licenseKeyEnabled When true, generates and sends a license key to your customer.
     * Defaults to false
     * @param array<string, string> $metadata Additional metadata for the product
     * @param string|null $name Optional name of the product
     *
     * @return Product<HasRawResponse>
     *
     * @throws APIException
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
        $params = [
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
        ];

        return $this->createRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return Product<HasRawResponse>
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): Product {
        [$parsed, $options] = ProductCreateParams::parseRequest(
            $params,
            $requestOptions
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
     *
     * @return Product<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): Product {
        $params = [];

        return $this->retrieveRaw($id, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return Product<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $id,
        mixed $params,
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
     * @param Dodopayments\Products\ProductUpdateParams\DigitalProductDelivery|null $digitalProductDelivery Choose how you would like you digital product delivered
     * @param string|null $imageID Product image id after its uploaded to S3
     * @param string|null $licenseKeyActivationMessage Message sent to the customer upon license key activation.
     *
     * Only applicable if `license_key_enabled` is `true`. This message contains instructions for
     * activating the license key.
     * @param int|null $licenseKeyActivationsLimit Limit for the number of activations for the license key.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the maximum number of times
     * the license key can be activated.
     * @param LicenseKeyDuration|null $licenseKeyDuration Duration of the license key if enabled.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the duration in days for which
     * the license key is valid.
     * @param bool|null $licenseKeyEnabled Whether the product requires a license key.
     *
     * If `true`, additional fields related to license key (duration, activations limit, activation message)
     * become applicable.
     * @param array<string, string>|null $metadata Additional metadata for the product
     * @param string|null $name name of the product, optional and must be at most 100 characters
     * @param OneTimePrice|RecurringPrice|UsageBasedPrice|null $price price details of the product
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory tax category of the product
     *
     * @throws APIException
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
        $params = [
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
        ];

        return $this->updateRaw($id, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $id,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = ProductUpdateParams::parseRequest(
            $params,
            $requestOptions
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
     *
     * @throws APIException
     */
    public function list(
        $archived = omit,
        $brandID = omit,
        $pageNumber = omit,
        $pageSize = omit,
        $recurring = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = [
            'archived' => $archived,
            'brandID' => $brandID,
            'pageNumber' => $pageNumber,
            'pageSize' => $pageSize,
            'recurring' => $recurring,
        ];

        return $this->listRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return DefaultPageNumberPagination<ProductListResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = ProductListParams::parseRequest(
            $params,
            $requestOptions
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
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = [];

        return $this->archiveRaw($id, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function archiveRaw(
        string $id,
        mixed $params,
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
     *
     * @throws APIException
     */
    public function unarchive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = [];

        return $this->unarchiveRaw($id, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function unarchiveRaw(
        string $id,
        mixed $params,
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
     *
     * @return ProductUpdateFilesResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateFiles(
        string $id,
        $fileName,
        ?RequestOptions $requestOptions = null
    ): ProductUpdateFilesResponse {
        $params = ['fileName' => $fileName];

        return $this->updateFilesRaw($id, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return ProductUpdateFilesResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateFilesRaw(
        string $id,
        array $params,
        ?RequestOptions $requestOptions = null
    ): ProductUpdateFilesResponse {
        [$parsed, $options] = ProductUpdateFilesParams::parseRequest(
            $params,
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
