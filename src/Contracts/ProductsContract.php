<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\LicenseKeyDuration;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\RecurringPrice;
use Dodopayments\Products\Product;
use Dodopayments\Products\ProductCreateParams\DigitalProductDelivery;
use Dodopayments\Products\ProductUpdateParams\DigitalProductDelivery as DigitalProductDelivery1;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Products\ProductListResponse;
use Dodopayments\Responses\Products\ProductUpdateFilesResponse;

interface ProductsContract
{
    /**
     * @param OneTimePrice|RecurringPrice $price Price configuration for the product
     * @param TaxCategory::* $taxCategory Tax category applied to this product
     * @param null|list<string> $addons Addons available for subscription product
     * @param null|string $brandID Brand id for the product, if not provided will default to primary brand
     * @param null|string $description Optional description of the product
     * @param null|DigitalProductDelivery $digitalProductDelivery Choose how you would like you digital product delivered
     * @param null|string $licenseKeyActivationMessage Optional message displayed during license key activation
     * @param null|int $licenseKeyActivationsLimit The number of times the license key can be activated.
     * Must be 0 or greater
     * @param LicenseKeyDuration $licenseKeyDuration Duration configuration for the license key.
     * Set to null if you don't want the license key to expire.
     * For subscriptions, the lifetime of the license key is tied to the subscription period
     * @param null|bool $licenseKeyEnabled When true, generates and sends a license key to your customer.
     * Defaults to false
     * @param array<string, string> $metadata Additional metadata for the product
     * @param null|string $name Optional name of the product
     */
    public function create(
        $price,
        $taxCategory,
        $addons = null,
        $brandID = null,
        $description = null,
        $digitalProductDelivery = null,
        $licenseKeyActivationMessage = null,
        $licenseKeyActivationsLimit = null,
        $licenseKeyDuration = null,
        $licenseKeyEnabled = null,
        $metadata = null,
        $name = null,
        ?RequestOptions $requestOptions = null,
    ): Product;

    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): Product;

    /**
     * @param null|list<string> $addons Available Addons for subscription products
     * @param null|string $brandID
     * @param null|string $description description of the product, optional and must be at most 1000 characters
     * @param null|DigitalProductDelivery1 $digitalProductDelivery Choose how you would like you digital product delivered
     * @param null|string $imageID Product image id after its uploaded to S3
     * @param null|string $licenseKeyActivationMessage Message sent to the customer upon license key activation.
     *
     * Only applicable if `license_key_enabled` is `true`. This message contains instructions for
     * activating the license key.
     * @param null|int $licenseKeyActivationsLimit Limit for the number of activations for the license key.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the maximum number of times
     * the license key can be activated.
     * @param LicenseKeyDuration $licenseKeyDuration Duration of the license key if enabled.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the duration in days for which
     * the license key is valid.
     * @param null|bool $licenseKeyEnabled Whether the product requires a license key.
     *
     * If `true`, additional fields related to license key (duration, activations limit, activation message)
     * become applicable.
     * @param null|array<string, string> $metadata Additional metadata for the product
     * @param null|string $name name of the product, optional and must be at most 100 characters
     * @param OneTimePrice|RecurringPrice $price price details of the product
     * @param TaxCategory::* $taxCategory tax category of the product
     */
    public function update(
        string $id,
        $addons = null,
        $brandID = null,
        $description = null,
        $digitalProductDelivery = null,
        $imageID = null,
        $licenseKeyActivationMessage = null,
        $licenseKeyActivationsLimit = null,
        $licenseKeyDuration = null,
        $licenseKeyEnabled = null,
        $metadata = null,
        $name = null,
        $price = null,
        $taxCategory = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @param bool $archived List archived products
     * @param string $brandID filter by Brand id
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param bool $recurring Filter products by pricing type:
     * - `true`: Show only recurring pricing products (e.g. subscriptions)
     * - `false`: Show only one-time price products
     * - `null` or absent: Show both types of products
     */
    public function list(
        $archived = null,
        $brandID = null,
        $pageNumber = null,
        $pageSize = null,
        $recurring = null,
        ?RequestOptions $requestOptions = null,
    ): ProductListResponse;

    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    public function unarchive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @param string $fileName
     */
    public function updateFiles(
        string $id,
        $fileName,
        ?RequestOptions $requestOptions = null
    ): ProductUpdateFilesResponse;
}
