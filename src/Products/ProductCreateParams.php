<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\OneTimePrice\Type;
use Dodopayments\Products\Price\RecurringPrice;
use Dodopayments\Products\Price\UsageBasedPrice;
use Dodopayments\Products\ProductCreateParams\DigitalProductDelivery;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * @see Dodopayments\Services\ProductsService::create()
 *
 * @phpstan-type ProductCreateParamsShape = array{
 *   name: string,
 *   price: OneTimePrice|array{
 *     currency: value-of<Currency>,
 *     discount: int,
 *     price: int,
 *     purchasing_power_parity: bool,
 *     type: value-of<Type>,
 *     pay_what_you_want?: bool|null,
 *     suggested_price?: int|null,
 *     tax_inclusive?: bool|null,
 *   }|RecurringPrice|array{
 *     currency: value-of<Currency>,
 *     discount: int,
 *     payment_frequency_count: int,
 *     payment_frequency_interval: value-of<TimeInterval>,
 *     price: int,
 *     purchasing_power_parity: bool,
 *     subscription_period_count: int,
 *     subscription_period_interval: value-of<TimeInterval>,
 *     type: value-of<\Dodopayments\Products\Price\RecurringPrice\Type>,
 *     tax_inclusive?: bool|null,
 *     trial_period_days?: int|null,
 *   }|UsageBasedPrice|array{
 *     currency: value-of<Currency>,
 *     discount: int,
 *     fixed_price: int,
 *     payment_frequency_count: int,
 *     payment_frequency_interval: value-of<TimeInterval>,
 *     purchasing_power_parity: bool,
 *     subscription_period_count: int,
 *     subscription_period_interval: value-of<TimeInterval>,
 *     type: value-of<\Dodopayments\Products\Price\UsageBasedPrice\Type>,
 *     meters?: list<AddMeterToPrice>|null,
 *     tax_inclusive?: bool|null,
 *   },
 *   tax_category: TaxCategory|value-of<TaxCategory>,
 *   addons?: list<string>|null,
 *   brand_id?: string|null,
 *   description?: string|null,
 *   digital_product_delivery?: null|DigitalProductDelivery|array{
 *     external_url?: string|null, instructions?: string|null
 *   },
 *   license_key_activation_message?: string|null,
 *   license_key_activations_limit?: int|null,
 *   license_key_duration?: null|LicenseKeyDuration|array{
 *     count: int, interval: value-of<TimeInterval>
 *   },
 *   license_key_enabled?: bool|null,
 *   metadata?: array<string,string>,
 * }
 */
final class ProductCreateParams implements BaseModel
{
    /** @use SdkModel<ProductCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Name of the product.
     */
    #[Api]
    public string $name;

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
     * `new ProductCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductCreateParams::with(name: ..., price: ..., tax_category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductCreateParams)->withName(...)->withPrice(...)->withTaxCategory(...)
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
     *   external_url?: string|null, instructions?: string|null
     * }|null $digital_product_delivery
     * @param LicenseKeyDuration|array{
     *   count: int, interval: value-of<TimeInterval>
     * }|null $license_key_duration
     * @param array<string,string> $metadata
     */
    public static function with(
        string $name,
        OneTimePrice|array|RecurringPrice|UsageBasedPrice $price,
        TaxCategory|string $tax_category,
        ?array $addons = null,
        ?string $brand_id = null,
        ?string $description = null,
        DigitalProductDelivery|array|null $digital_product_delivery = null,
        ?string $license_key_activation_message = null,
        ?int $license_key_activations_limit = null,
        LicenseKeyDuration|array|null $license_key_duration = null,
        ?bool $license_key_enabled = null,
        ?array $metadata = null,
    ): self {
        $obj = new self;

        $obj['name'] = $name;
        $obj['price'] = $price;
        $obj['tax_category'] = $tax_category;

        null !== $addons && $obj['addons'] = $addons;
        null !== $brand_id && $obj['brand_id'] = $brand_id;
        null !== $description && $obj['description'] = $description;
        null !== $digital_product_delivery && $obj['digital_product_delivery'] = $digital_product_delivery;
        null !== $license_key_activation_message && $obj['license_key_activation_message'] = $license_key_activation_message;
        null !== $license_key_activations_limit && $obj['license_key_activations_limit'] = $license_key_activations_limit;
        null !== $license_key_duration && $obj['license_key_duration'] = $license_key_duration;
        null !== $license_key_enabled && $obj['license_key_enabled'] = $license_key_enabled;
        null !== $metadata && $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * Name of the product.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * Price configuration for the product.
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
        $obj['addons'] = $addons;

        return $obj;
    }

    /**
     * Brand id for the product, if not provided will default to primary brand.
     */
    public function withBrandID(?string $brandID): self
    {
        $obj = clone $this;
        $obj['brand_id'] = $brandID;

        return $obj;
    }

    /**
     * Optional description of the product.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    /**
     * Choose how you would like you digital product delivered.
     *
     * @param DigitalProductDelivery|array{
     *   external_url?: string|null, instructions?: string|null
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
     * Optional message displayed during license key activation.
     */
    public function withLicenseKeyActivationMessage(
        ?string $licenseKeyActivationMessage
    ): self {
        $obj = clone $this;
        $obj['license_key_activation_message'] = $licenseKeyActivationMessage;

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
        $obj['license_key_activations_limit'] = $licenseKeyActivationsLimit;

        return $obj;
    }

    /**
     * Duration configuration for the license key.
     * Set to null if you don't want the license key to expire.
     * For subscriptions, the lifetime of the license key is tied to the subscription period.
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
     * When true, generates and sends a license key to your customer.
     * Defaults to false.
     */
    public function withLicenseKeyEnabled(?bool $licenseKeyEnabled): self
    {
        $obj = clone $this;
        $obj['license_key_enabled'] = $licenseKeyEnabled;

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
        $obj['metadata'] = $metadata;

        return $obj;
    }
}
