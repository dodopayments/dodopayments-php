<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\OneTimePrice\Type;
use Dodopayments\Products\Price\RecurringPrice;
use Dodopayments\Products\Price\UsageBasedPrice;
use Dodopayments\Products\Product\DigitalProductDelivery;
use Dodopayments\Products\Product\DigitalProductDelivery\File;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * @phpstan-type ProductShape = array{
 *   brand_id: string,
 *   business_id: string,
 *   created_at: \DateTimeInterface,
 *   is_recurring: bool,
 *   license_key_enabled: bool,
 *   metadata: array<string,string>,
 *   price: OneTimePrice|RecurringPrice|UsageBasedPrice,
 *   product_id: string,
 *   tax_category: value-of<TaxCategory>,
 *   updated_at: \DateTimeInterface,
 *   addons?: list<string>|null,
 *   description?: string|null,
 *   digital_product_delivery?: DigitalProductDelivery|null,
 *   image?: string|null,
 *   license_key_activation_message?: string|null,
 *   license_key_activations_limit?: int|null,
 *   license_key_duration?: LicenseKeyDuration|null,
 *   name?: string|null,
 * }
 */
final class Product implements BaseModel
{
    /** @use SdkModel<ProductShape> */
    use SdkModel;

    #[Required]
    public string $brand_id;

    /**
     * Unique identifier for the business to which the product belongs.
     */
    #[Required]
    public string $business_id;

    /**
     * Timestamp when the product was created.
     */
    #[Required]
    public \DateTimeInterface $created_at;

    /**
     * Indicates if the product is recurring (e.g., subscriptions).
     */
    #[Required]
    public bool $is_recurring;

    /**
     * Indicates whether the product requires a license key.
     */
    #[Required]
    public bool $license_key_enabled;

    /**
     * Additional custom data associated with the product.
     *
     * @var array<string,string> $metadata
     */
    #[Required(map: 'string')]
    public array $metadata;

    /**
     * Pricing information for the product.
     */
    #[Required]
    public OneTimePrice|RecurringPrice|UsageBasedPrice $price;

    /**
     * Unique identifier for the product.
     */
    #[Required]
    public string $product_id;

    /**
     * Tax category associated with the product.
     *
     * @var value-of<TaxCategory> $tax_category
     */
    #[Required(enum: TaxCategory::class)]
    public string $tax_category;

    /**
     * Timestamp when the product was last updated.
     */
    #[Required]
    public \DateTimeInterface $updated_at;

    /**
     * Available Addons for subscription products.
     *
     * @var list<string>|null $addons
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $addons;

    /**
     * Description of the product, optional.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional(nullable: true)]
    public ?DigitalProductDelivery $digital_product_delivery;

    /**
     * URL of the product image, optional.
     */
    #[Optional(nullable: true)]
    public ?string $image;

    /**
     * Message sent upon license key activation, if applicable.
     */
    #[Optional(nullable: true)]
    public ?string $license_key_activation_message;

    /**
     * Limit on the number of activations for the license key, if enabled.
     */
    #[Optional(nullable: true)]
    public ?int $license_key_activations_limit;

    /**
     * Duration of the license key validity, if enabled.
     */
    #[Optional(nullable: true)]
    public ?LicenseKeyDuration $license_key_duration;

    /**
     * Name of the product, optional.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * `new Product()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Product::with(
     *   brand_id: ...,
     *   business_id: ...,
     *   created_at: ...,
     *   is_recurring: ...,
     *   license_key_enabled: ...,
     *   metadata: ...,
     *   price: ...,
     *   product_id: ...,
     *   tax_category: ...,
     *   updated_at: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Product)
     *   ->withBrandID(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withIsRecurring(...)
     *   ->withLicenseKeyEnabled(...)
     *   ->withMetadata(...)
     *   ->withPrice(...)
     *   ->withProductID(...)
     *   ->withTaxCategory(...)
     *   ->withUpdatedAt(...)
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
     * @param array<string,string> $metadata
     * @param OneTimePrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   price: int,
     *   purchasing_power_parity: bool,
     *   type: value-of<Type>,
     *   pay_what_you_want?: bool|null,
     *   suggested_price?: int|null,
     *   tax_inclusive?: bool|null,
     * }|RecurringPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   payment_frequency_count: int,
     *   payment_frequency_interval: value-of<TimeInterval>,
     *   price: int,
     *   purchasing_power_parity: bool,
     *   subscription_period_count: int,
     *   subscription_period_interval: value-of<TimeInterval>,
     *   type: value-of<RecurringPrice\Type>,
     *   tax_inclusive?: bool|null,
     *   trial_period_days?: int|null,
     * }|UsageBasedPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   fixed_price: int,
     *   payment_frequency_count: int,
     *   payment_frequency_interval: value-of<TimeInterval>,
     *   purchasing_power_parity: bool,
     *   subscription_period_count: int,
     *   subscription_period_interval: value-of<TimeInterval>,
     *   type: value-of<UsageBasedPrice\Type>,
     *   meters?: list<AddMeterToPrice>|null,
     *   tax_inclusive?: bool|null,
     * } $price
     * @param TaxCategory|value-of<TaxCategory> $tax_category
     * @param list<string>|null $addons
     * @param DigitalProductDelivery|array{
     *   external_url?: string|null,
     *   files?: list<File>|null,
     *   instructions?: string|null,
     * }|null $digital_product_delivery
     * @param LicenseKeyDuration|array{
     *   count: int, interval: value-of<TimeInterval>
     * }|null $license_key_duration
     */
    public static function with(
        string $brand_id,
        string $business_id,
        \DateTimeInterface $created_at,
        bool $is_recurring,
        bool $license_key_enabled,
        array $metadata,
        OneTimePrice|array|RecurringPrice|UsageBasedPrice $price,
        string $product_id,
        TaxCategory|string $tax_category,
        \DateTimeInterface $updated_at,
        ?array $addons = null,
        ?string $description = null,
        DigitalProductDelivery|array|null $digital_product_delivery = null,
        ?string $image = null,
        ?string $license_key_activation_message = null,
        ?int $license_key_activations_limit = null,
        LicenseKeyDuration|array|null $license_key_duration = null,
        ?string $name = null,
    ): self {
        $obj = new self;

        $obj['brand_id'] = $brand_id;
        $obj['business_id'] = $business_id;
        $obj['created_at'] = $created_at;
        $obj['is_recurring'] = $is_recurring;
        $obj['license_key_enabled'] = $license_key_enabled;
        $obj['metadata'] = $metadata;
        $obj['price'] = $price;
        $obj['product_id'] = $product_id;
        $obj['tax_category'] = $tax_category;
        $obj['updated_at'] = $updated_at;

        null !== $addons && $obj['addons'] = $addons;
        null !== $description && $obj['description'] = $description;
        null !== $digital_product_delivery && $obj['digital_product_delivery'] = $digital_product_delivery;
        null !== $image && $obj['image'] = $image;
        null !== $license_key_activation_message && $obj['license_key_activation_message'] = $license_key_activation_message;
        null !== $license_key_activations_limit && $obj['license_key_activations_limit'] = $license_key_activations_limit;
        null !== $license_key_duration && $obj['license_key_duration'] = $license_key_duration;
        null !== $name && $obj['name'] = $name;

        return $obj;
    }

    public function withBrandID(string $brandID): self
    {
        $obj = clone $this;
        $obj['brand_id'] = $brandID;

        return $obj;
    }

    /**
     * Unique identifier for the business to which the product belongs.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['business_id'] = $businessID;

        return $obj;
    }

    /**
     * Timestamp when the product was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * Indicates if the product is recurring (e.g., subscriptions).
     */
    public function withIsRecurring(bool $isRecurring): self
    {
        $obj = clone $this;
        $obj['is_recurring'] = $isRecurring;

        return $obj;
    }

    /**
     * Indicates whether the product requires a license key.
     */
    public function withLicenseKeyEnabled(bool $licenseKeyEnabled): self
    {
        $obj = clone $this;
        $obj['license_key_enabled'] = $licenseKeyEnabled;

        return $obj;
    }

    /**
     * Additional custom data associated with the product.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * Pricing information for the product.
     *
     * @param OneTimePrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   price: int,
     *   purchasing_power_parity: bool,
     *   type: value-of<Type>,
     *   pay_what_you_want?: bool|null,
     *   suggested_price?: int|null,
     *   tax_inclusive?: bool|null,
     * }|RecurringPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   payment_frequency_count: int,
     *   payment_frequency_interval: value-of<TimeInterval>,
     *   price: int,
     *   purchasing_power_parity: bool,
     *   subscription_period_count: int,
     *   subscription_period_interval: value-of<TimeInterval>,
     *   type: value-of<RecurringPrice\Type>,
     *   tax_inclusive?: bool|null,
     *   trial_period_days?: int|null,
     * }|UsageBasedPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   fixed_price: int,
     *   payment_frequency_count: int,
     *   payment_frequency_interval: value-of<TimeInterval>,
     *   purchasing_power_parity: bool,
     *   subscription_period_count: int,
     *   subscription_period_interval: value-of<TimeInterval>,
     *   type: value-of<UsageBasedPrice\Type>,
     *   meters?: list<AddMeterToPrice>|null,
     *   tax_inclusive?: bool|null,
     * } $price
     */
    public function withPrice(
        OneTimePrice|array|RecurringPrice|UsageBasedPrice $price
    ): self {
        $obj = clone $this;
        $obj['price'] = $price;

        return $obj;
    }

    /**
     * Unique identifier for the product.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj['product_id'] = $productID;

        return $obj;
    }

    /**
     * Tax category associated with the product.
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
     * Timestamp when the product was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj['updated_at'] = $updatedAt;

        return $obj;
    }

    /**
     * Available Addons for subscription products.
     *
     * @param list<string>|null $addons
     */
    public function withAddons(?array $addons): self
    {
        $obj = clone $this;
        $obj['addons'] = $addons;

        return $obj;
    }

    /**
     * Description of the product, optional.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * @param DigitalProductDelivery|array{
     *   external_url?: string|null,
     *   files?: list<File>|null,
     *   instructions?: string|null,
     * }|null $digitalProductDelivery
     */
    public function withDigitalProductDelivery(
        DigitalProductDelivery|array|null $digitalProductDelivery
    ): self {
        $obj = clone $this;
        $obj['digital_product_delivery'] = $digitalProductDelivery;

        return $obj;
    }

    /**
     * URL of the product image, optional.
     */
    public function withImage(?string $image): self
    {
        $obj = clone $this;
        $obj['image'] = $image;

        return $obj;
    }

    /**
     * Message sent upon license key activation, if applicable.
     */
    public function withLicenseKeyActivationMessage(
        ?string $licenseKeyActivationMessage
    ): self {
        $obj = clone $this;
        $obj['license_key_activation_message'] = $licenseKeyActivationMessage;

        return $obj;
    }

    /**
     * Limit on the number of activations for the license key, if enabled.
     */
    public function withLicenseKeyActivationsLimit(
        ?int $licenseKeyActivationsLimit
    ): self {
        $obj = clone $this;
        $obj['license_key_activations_limit'] = $licenseKeyActivationsLimit;

        return $obj;
    }

    /**
     * Duration of the license key validity, if enabled.
     *
     * @param LicenseKeyDuration|array{
     *   count: int, interval: value-of<TimeInterval>
     * }|null $licenseKeyDuration
     */
    public function withLicenseKeyDuration(
        LicenseKeyDuration|array|null $licenseKeyDuration
    ): self {
        $obj = clone $this;
        $obj['license_key_duration'] = $licenseKeyDuration;

        return $obj;
    }

    /**
     * Name of the product, optional.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }
}
