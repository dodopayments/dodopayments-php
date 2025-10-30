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
 * @see Dodopayments\Products->create
 *
 * @phpstan-type ProductCreateParamsShape = array{
 *   price: OneTimePrice|RecurringPrice|UsageBasedPrice,
 *   taxCategory: TaxCategory|value-of<TaxCategory>,
 *   addons?: list<string>|null,
 *   brandID?: string|null,
 *   description?: string|null,
 *   digitalProductDelivery?: DigitalProductDelivery|null,
 *   licenseKeyActivationMessage?: string|null,
 *   licenseKeyActivationsLimit?: int|null,
 *   licenseKeyDuration?: LicenseKeyDuration|null,
 *   licenseKeyEnabled?: bool|null,
 *   metadata?: array<string, string>,
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
     * @var value-of<TaxCategory> $taxCategory
     */
    #[Api('tax_category', enum: TaxCategory::class)]
    public string $taxCategory;

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
    #[Api('brand_id', nullable: true, optional: true)]
    public ?string $brandID;

    /**
     * Optional description of the product.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * Choose how you would like you digital product delivered.
     */
    #[Api('digital_product_delivery', nullable: true, optional: true)]
    public ?DigitalProductDelivery $digitalProductDelivery;

    /**
     * Optional message displayed during license key activation.
     */
    #[Api('license_key_activation_message', nullable: true, optional: true)]
    public ?string $licenseKeyActivationMessage;

    /**
     * The number of times the license key can be activated.
     * Must be 0 or greater.
     */
    #[Api('license_key_activations_limit', nullable: true, optional: true)]
    public ?int $licenseKeyActivationsLimit;

    /**
     * Duration configuration for the license key.
     * Set to null if you don't want the license key to expire.
     * For subscriptions, the lifetime of the license key is tied to the subscription period.
     */
    #[Api('license_key_duration', nullable: true, optional: true)]
    public ?LicenseKeyDuration $licenseKeyDuration;

    /**
     * When true, generates and sends a license key to your customer.
     * Defaults to false.
     */
    #[Api('license_key_enabled', nullable: true, optional: true)]
    public ?bool $licenseKeyEnabled;

    /**
     * Additional metadata for the product.
     *
     * @var array<string, string>|null $metadata
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
     * ProductCreateParams::with(price: ..., taxCategory: ...)
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
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     * @param list<string>|null $addons
     * @param array<string, string> $metadata
     */
    public static function with(
        OneTimePrice|RecurringPrice|UsageBasedPrice $price,
        TaxCategory|string $taxCategory,
        ?array $addons = null,
        ?string $brandID = null,
        ?string $description = null,
        ?DigitalProductDelivery $digitalProductDelivery = null,
        ?string $licenseKeyActivationMessage = null,
        ?int $licenseKeyActivationsLimit = null,
        ?LicenseKeyDuration $licenseKeyDuration = null,
        ?bool $licenseKeyEnabled = null,
        ?array $metadata = null,
        ?string $name = null,
    ): self {
        $obj = new self;

        $obj->price = $price;
        $obj['taxCategory'] = $taxCategory;

        null !== $addons && $obj->addons = $addons;
        null !== $brandID && $obj->brandID = $brandID;
        null !== $description && $obj->description = $description;
        null !== $digitalProductDelivery && $obj->digitalProductDelivery = $digitalProductDelivery;
        null !== $licenseKeyActivationMessage && $obj->licenseKeyActivationMessage = $licenseKeyActivationMessage;
        null !== $licenseKeyActivationsLimit && $obj->licenseKeyActivationsLimit = $licenseKeyActivationsLimit;
        null !== $licenseKeyDuration && $obj->licenseKeyDuration = $licenseKeyDuration;
        null !== $licenseKeyEnabled && $obj->licenseKeyEnabled = $licenseKeyEnabled;
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
        $obj['taxCategory'] = $taxCategory;

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
        $obj->brandID = $brandID;

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
        $obj->digitalProductDelivery = $digitalProductDelivery;

        return $obj;
    }

    /**
     * Optional message displayed during license key activation.
     */
    public function withLicenseKeyActivationMessage(
        ?string $licenseKeyActivationMessage
    ): self {
        $obj = clone $this;
        $obj->licenseKeyActivationMessage = $licenseKeyActivationMessage;

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
        $obj->licenseKeyActivationsLimit = $licenseKeyActivationsLimit;

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
        $obj->licenseKeyDuration = $licenseKeyDuration;

        return $obj;
    }

    /**
     * When true, generates and sends a license key to your customer.
     * Defaults to false.
     */
    public function withLicenseKeyEnabled(?bool $licenseKeyEnabled): self
    {
        $obj = clone $this;
        $obj->licenseKeyEnabled = $licenseKeyEnabled;

        return $obj;
    }

    /**
     * Additional metadata for the product.
     *
     * @param array<string, string> $metadata
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
