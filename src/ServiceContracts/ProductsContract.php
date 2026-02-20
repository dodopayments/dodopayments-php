<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\LicenseKeyDuration;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\RecurringPrice;
use Dodopayments\Products\Price\UsageBasedPrice;
use Dodopayments\Products\Product;
use Dodopayments\Products\ProductCreateParams\CreditEntitlement;
use Dodopayments\Products\ProductCreateParams\DigitalProductDelivery;
use Dodopayments\Products\ProductListResponse;
use Dodopayments\Products\ProductUpdateFilesResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type CreditEntitlementShape from \Dodopayments\Products\ProductCreateParams\CreditEntitlement
 * @phpstan-import-type DigitalProductDeliveryShape from \Dodopayments\Products\ProductCreateParams\DigitalProductDelivery
 * @phpstan-import-type CreditEntitlementShape from \Dodopayments\Products\ProductUpdateParams\CreditEntitlement as CreditEntitlementShape1
 * @phpstan-import-type DigitalProductDeliveryShape from \Dodopayments\Products\ProductUpdateParams\DigitalProductDelivery as DigitalProductDeliveryShape1
 * @phpstan-import-type PriceShape from \Dodopayments\Products\Price
 * @phpstan-import-type LicenseKeyDurationShape from \Dodopayments\Products\LicenseKeyDuration
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface ProductsContract
{
    /**
     * @api
     *
     * @param string $name Name of the product
     * @param PriceShape $price Price configuration for the product
     * @param TaxCategory|value-of<TaxCategory> $taxCategory Tax category applied to this product
     * @param list<string>|null $addons Addons available for subscription product
     * @param string|null $brandID Brand id for the product, if not provided will default to primary brand
     * @param list<CreditEntitlement|CreditEntitlementShape>|null $creditEntitlements Optional credit entitlements to attach (max 3)
     * @param string|null $description Optional description of the product
     * @param DigitalProductDelivery|DigitalProductDeliveryShape|null $digitalProductDelivery Choose how you would like you digital product delivered
     * @param string|null $licenseKeyActivationMessage Optional message displayed during license key activation
     * @param int|null $licenseKeyActivationsLimit The number of times the license key can be activated.
     * Must be 0 or greater
     * @param LicenseKeyDuration|LicenseKeyDurationShape|null $licenseKeyDuration Duration configuration for the license key.
     * Set to null if you don't want the license key to expire.
     * For subscriptions, the lifetime of the license key is tied to the subscription period
     * @param bool|null $licenseKeyEnabled When true, generates and sends a license key to your customer.
     * Defaults to false
     * @param array<string,string> $metadata Additional metadata for the product
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        OneTimePrice|array|RecurringPrice|UsageBasedPrice $price,
        TaxCategory|string $taxCategory,
        ?array $addons = null,
        ?string $brandID = null,
        ?array $creditEntitlements = null,
        ?string $description = null,
        DigitalProductDelivery|array|null $digitalProductDelivery = null,
        ?string $licenseKeyActivationMessage = null,
        ?int $licenseKeyActivationsLimit = null,
        LicenseKeyDuration|array|null $licenseKeyDuration = null,
        ?bool $licenseKeyEnabled = null,
        ?array $metadata = null,
        RequestOptions|array|null $requestOptions = null,
    ): Product;

    /**
     * @api
     *
     * @param string $id Product Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): Product;

    /**
     * @api
     *
     * @param list<string>|null $addons Available Addons for subscription products
     * @param list<\Dodopayments\Products\ProductUpdateParams\CreditEntitlement|CreditEntitlementShape1>|null $creditEntitlements Credit entitlements to update (replaces all existing when present)
     * Send empty array to remove all, omit field to leave unchanged
     * @param string|null $description description of the product, optional and must be at most 1000 characters
     * @param \Dodopayments\Products\ProductUpdateParams\DigitalProductDelivery|DigitalProductDeliveryShape1|null $digitalProductDelivery Choose how you would like you digital product delivered
     * @param string|null $imageID Product image id after its uploaded to S3
     * @param string|null $licenseKeyActivationMessage Message sent to the customer upon license key activation.
     *
     * Only applicable if `license_key_enabled` is `true`. This message contains instructions for
     * activating the license key.
     * @param int|null $licenseKeyActivationsLimit Limit for the number of activations for the license key.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the maximum number of times
     * the license key can be activated.
     * @param LicenseKeyDuration|LicenseKeyDurationShape|null $licenseKeyDuration Duration of the license key if enabled.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the duration in days for which
     * the license key is valid.
     * @param bool|null $licenseKeyEnabled Whether the product requires a license key.
     *
     * If `true`, additional fields related to license key (duration, activations limit, activation message)
     * become applicable.
     * @param array<string,string>|null $metadata Additional metadata for the product
     * @param string|null $name name of the product, optional and must be at most 100 characters
     * @param PriceShape|null $price price details of the product
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory tax category of the product
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?array $addons = null,
        ?string $brandID = null,
        ?array $creditEntitlements = null,
        ?string $description = null,
        \Dodopayments\Products\ProductUpdateParams\DigitalProductDelivery|array|null $digitalProductDelivery = null,
        ?string $imageID = null,
        ?string $licenseKeyActivationMessage = null,
        ?int $licenseKeyActivationsLimit = null,
        LicenseKeyDuration|array|null $licenseKeyDuration = null,
        ?bool $licenseKeyEnabled = null,
        ?array $metadata = null,
        ?string $name = null,
        OneTimePrice|array|RecurringPrice|UsageBasedPrice|null $price = null,
        TaxCategory|string|null $taxCategory = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

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
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<ProductListResponse>
     *
     * @throws APIException
     */
    public function list(
        ?bool $archived = null,
        ?string $brandID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?bool $recurring = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function unarchive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $id Product Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateFiles(
        string $id,
        string $fileName,
        RequestOptions|array|null $requestOptions = null,
    ): ProductUpdateFilesResponse;
}
