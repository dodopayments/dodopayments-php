<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\RecurringPrice;
use Dodopayments\Products\Price\UsageBasedPrice;
use Dodopayments\Products\ProductCreateParams\DigitalProductDelivery;

/**
 * @see Dodopayments\Services\ProductsService::create()
 *
 * @phpstan-type ProductCreateParamsShape = array{
 *   price: OneTimePrice|RecurringPrice|UsageBasedPrice,
 *   tax_category: TaxCategory|value-of<TaxCategory>,
 *   addons?: list<string>|null,
 *   brand_id?: string|null,
 *   description?: string|null,
 *   digital_product_delivery?: DigitalProductDelivery|null,
 *   license_key_activation_message?: string|null,
 *   license_key_activations_limit?: int|null,
 *   license_key_duration?: LicenseKeyDuration|null,
 *   license_key_enabled?: bool|null,
 *   metadata?: array<string,string>,
 *   name?: string|null,
 * }
 */
final class ProductCreateParams implements BaseModel
{
    /** @use SdkModel<ProductCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Price configuration for the product.
     */
    #[Api]
    public OneTimePrice|RecurringPrice|UsageBasedPrice $price;

    /**
     * Tax category applied to this product.
     *
     * @var value-of<TaxCategory> $tax_category
     */
    #[Api(enum: TaxCategory::class)]
    public string $tax_category;

    /**
     * Addons available for subscription product.
     *
     * @var list<string>|null $addons
     */
    #[Api(list: 'string', nullable: true, optional: true)]
    public ?array $addons;

    /**
     * Brand id for the product, if not provided will default to primary brand.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $brand_id;

    /**
     * Optional description of the product.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * Choose how you would like you digital product delivered.
     */
    #[Api(nullable: true, optional: true)]
    public ?DigitalProductDelivery $digital_product_delivery;

    /**
     * Optional message displayed during license key activation.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $license_key_activation_message;

    /**
     * The number of times the license key can be activated.
     * Must be 0 or greater.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $license_key_activations_limit;

    /**
     * Duration configuration for the license key.
     * Set to null if you don't want the license key to expire.
     * For subscriptions, the lifetime of the license key is tied to the subscription period.
     */
    #[Api(nullable: true, optional: true)]
    public ?LicenseKeyDuration $license_key_duration;

    /**
     * When true, generates and sends a license key to your customer.
     * Defaults to false.
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $license_key_enabled;

    /**
     * Additional metadata for the product.
     *
     * @var array<string,string>|null $metadata
     */
    #[Api(map: 'string', optional: true)]
    public ?array $metadata;

    /**
     * Optional name of the product.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $name;

    /**
     * `new ProductCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductCreateParams::with(price: ..., tax_category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductCreateParams)->withPrice(...)->withTaxCategory(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param TaxCategory|value-of<TaxCategory> $tax_category
     * @param list<string>|null $addons
     * @param array<string,string> $metadata
     */
    public static function with(
        OneTimePrice|RecurringPrice|UsageBasedPrice $price,
        TaxCategory|string $tax_category,
        ?array $addons = null,
        ?string $brand_id = null,
        ?string $description = null,
        ?DigitalProductDelivery $digital_product_delivery = null,
        ?string $license_key_activation_message = null,
        ?int $license_key_activations_limit = null,
        ?LicenseKeyDuration $license_key_duration = null,
        ?bool $license_key_enabled = null,
        ?array $metadata = null,
        ?string $name = null,
    ): self {
        $obj = new self;

        $obj->price = $price;
        $obj['tax_category'] = $tax_category;

        null !== $addons && $obj->addons = $addons;
        null !== $brand_id && $obj->brand_id = $brand_id;
        null !== $description && $obj->description = $description;
        null !== $digital_product_delivery && $obj->digital_product_delivery = $digital_product_delivery;
        null !== $license_key_activation_message && $obj->license_key_activation_message = $license_key_activation_message;
        null !== $license_key_activations_limit && $obj->license_key_activations_limit = $license_key_activations_limit;
        null !== $license_key_duration && $obj->license_key_duration = $license_key_duration;
        null !== $license_key_enabled && $obj->license_key_enabled = $license_key_enabled;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $name && $obj->name = $name;

        return $obj;
    }

    /**
     * Price configuration for the product.
     */
    public function withPrice(
        OneTimePrice|RecurringPrice|UsageBasedPrice $price
    ): self {
        $obj = clone $this;
        $obj->price = $price;

        return $obj;
    }

    /**
     * Tax category applied to this product.
     *
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     */
    public function withTaxCategory(TaxCategory|string $taxCategory): self
    {
        $obj = clone $this;
        $obj['tax_category'] = $taxCategory;

        return $obj;
    }

    /**
     * Addons available for subscription product.
     *
     * @param list<string>|null $addons
     */
    public function withAddons(?array $addons): self
    {
        $obj = clone $this;
        $obj->addons = $addons;

        return $obj;
    }

    /**
     * Brand id for the product, if not provided will default to primary brand.
     */
    public function withBrandID(?string $brandID): self
    {
        $obj = clone $this;
        $obj->brand_id = $brandID;

        return $obj;
    }

    /**
     * Optional description of the product.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * Choose how you would like you digital product delivered.
     */
    public function withDigitalProductDelivery(
        ?DigitalProductDelivery $digitalProductDelivery
    ): self {
        $obj = clone $this;
        $obj->digital_product_delivery = $digitalProductDelivery;

        return $obj;
    }

    /**
     * Optional message displayed during license key activation.
     */
    public function withLicenseKeyActivationMessage(
        ?string $licenseKeyActivationMessage
    ): self {
        $obj = clone $this;
        $obj->license_key_activation_message = $licenseKeyActivationMessage;

        return $obj;
    }

    /**
     * The number of times the license key can be activated.
     * Must be 0 or greater.
     */
    public function withLicenseKeyActivationsLimit(
        ?int $licenseKeyActivationsLimit
    ): self {
        $obj = clone $this;
        $obj->license_key_activations_limit = $licenseKeyActivationsLimit;

        return $obj;
    }

    /**
     * Duration configuration for the license key.
     * Set to null if you don't want the license key to expire.
     * For subscriptions, the lifetime of the license key is tied to the subscription period.
     */
    public function withLicenseKeyDuration(
        ?LicenseKeyDuration $licenseKeyDuration
    ): self {
        $obj = clone $this;
        $obj->license_key_duration = $licenseKeyDuration;

        return $obj;
    }

    /**
     * When true, generates and sends a license key to your customer.
     * Defaults to false.
     */
    public function withLicenseKeyEnabled(?bool $licenseKeyEnabled): self
    {
        $obj = clone $this;
        $obj->license_key_enabled = $licenseKeyEnabled;

        return $obj;
    }

    /**
     * Additional metadata for the product.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * Optional name of the product.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }
}
