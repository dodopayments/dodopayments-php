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
use Dodopayments\Products\ProductUpdateParams\DigitalProductDelivery;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * @see Dodopayments\Services\ProductsService::update()
 *
 * @phpstan-type ProductUpdateParamsShape = array{
 *   addons?: list<string>|null,
 *   brand_id?: string|null,
 *   description?: string|null,
 *   digital_product_delivery?: null|DigitalProductDelivery|array{
 *     external_url?: string|null,
 *     files?: list<string>|null,
 *     instructions?: string|null,
 *   },
 *   image_id?: string|null,
 *   license_key_activation_message?: string|null,
 *   license_key_activations_limit?: int|null,
 *   license_key_duration?: null|LicenseKeyDuration|array{
 *     count: int, interval: value-of<TimeInterval>
 *   },
 *   license_key_enabled?: bool|null,
 *   metadata?: array<string,string>|null,
 *   name?: string|null,
 *   price?: null|OneTimePrice|array{
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
 *   tax_category?: null|TaxCategory|value-of<TaxCategory>,
 * }
 */
final class ProductUpdateParams implements BaseModel
{
    /** @use SdkModel<ProductUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Available Addons for subscription products.
     *
     * @var list<string>|null $addons
     */
    #[Api(list: 'string', nullable: true, optional: true)]
    public ?array $addons;

    #[Api(nullable: true, optional: true)]
    public ?string $brand_id;

    /**
     * Description of the product, optional and must be at most 1000 characters.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * Choose how you would like you digital product delivered.
     */
    #[Api(nullable: true, optional: true)]
    public ?DigitalProductDelivery $digital_product_delivery;

    /**
     * Product image id after its uploaded to S3.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $image_id;

    /**
     * Message sent to the customer upon license key activation.
     *
     * Only applicable if `license_key_enabled` is `true`. This message contains instructions for
     * activating the license key.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $license_key_activation_message;

    /**
     * Limit for the number of activations for the license key.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the maximum number of times
     * the license key can be activated.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $license_key_activations_limit;

    /**
     * Duration of the license key if enabled.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the duration in days for which
     * the license key is valid.
     */
    #[Api(nullable: true, optional: true)]
    public ?LicenseKeyDuration $license_key_duration;

    /**
     * Whether the product requires a license key.
     *
     * If `true`, additional fields related to license key (duration, activations limit, activation message)
     * become applicable.
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $license_key_enabled;

    /**
     * Additional metadata for the product.
     *
     * @var array<string,string>|null $metadata
     */
    #[Api(map: 'string', nullable: true, optional: true)]
    public ?array $metadata;

    /**
     * Name of the product, optional and must be at most 100 characters.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $name;

    /**
     * Price details of the product.
     */
    #[Api(nullable: true, optional: true)]
    public OneTimePrice|RecurringPrice|UsageBasedPrice|null $price;

    /**
     * Tax category of the product.
     *
     * @var value-of<TaxCategory>|null $tax_category
     */
    #[Api(enum: TaxCategory::class, nullable: true, optional: true)]
    public ?string $tax_category;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $addons
     * @param DigitalProductDelivery|array{
     *   external_url?: string|null,
     *   files?: list<string>|null,
     *   instructions?: string|null,
     * }|null $digital_product_delivery
     * @param LicenseKeyDuration|array{
     *   count: int, interval: value-of<TimeInterval>
     * }|null $license_key_duration
     * @param array<string,string>|null $metadata
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
     * }|null $price
     * @param TaxCategory|value-of<TaxCategory>|null $tax_category
     */
    public static function with(
        ?array $addons = null,
        ?string $brand_id = null,
        ?string $description = null,
        DigitalProductDelivery|array|null $digital_product_delivery = null,
        ?string $image_id = null,
        ?string $license_key_activation_message = null,
        ?int $license_key_activations_limit = null,
        LicenseKeyDuration|array|null $license_key_duration = null,
        ?bool $license_key_enabled = null,
        ?array $metadata = null,
        ?string $name = null,
        OneTimePrice|array|RecurringPrice|UsageBasedPrice|null $price = null,
        TaxCategory|string|null $tax_category = null,
    ): self {
        $obj = new self;

        null !== $addons && $obj['addons'] = $addons;
        null !== $brand_id && $obj['brand_id'] = $brand_id;
        null !== $description && $obj['description'] = $description;
        null !== $digital_product_delivery && $obj['digital_product_delivery'] = $digital_product_delivery;
        null !== $image_id && $obj['image_id'] = $image_id;
        null !== $license_key_activation_message && $obj['license_key_activation_message'] = $license_key_activation_message;
        null !== $license_key_activations_limit && $obj['license_key_activations_limit'] = $license_key_activations_limit;
        null !== $license_key_duration && $obj['license_key_duration'] = $license_key_duration;
        null !== $license_key_enabled && $obj['license_key_enabled'] = $license_key_enabled;
        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $name && $obj['name'] = $name;
        null !== $price && $obj['price'] = $price;
        null !== $tax_category && $obj['tax_category'] = $tax_category;

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

    public function withBrandID(?string $brandID): self
    {
        $obj = clone $this;
        $obj['brand_id'] = $brandID;

        return $obj;
    }

    /**
     * Description of the product, optional and must be at most 1000 characters.
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
     *   external_url?: string|null,
     *   files?: list<string>|null,
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
     * Product image id after its uploaded to S3.
     */
    public function withImageID(?string $imageID): self
    {
        $obj = clone $this;
        $obj['image_id'] = $imageID;

        return $obj;
    }

    /**
     * Message sent to the customer upon license key activation.
     *
     * Only applicable if `license_key_enabled` is `true`. This message contains instructions for
     * activating the license key.
     */
    public function withLicenseKeyActivationMessage(
        ?string $licenseKeyActivationMessage
    ): self {
        $obj = clone $this;
        $obj['license_key_activation_message'] = $licenseKeyActivationMessage;

        return $obj;
    }

    /**
     * Limit for the number of activations for the license key.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the maximum number of times
     * the license key can be activated.
     */
    public function withLicenseKeyActivationsLimit(
        ?int $licenseKeyActivationsLimit
    ): self {
        $obj = clone $this;
        $obj['license_key_activations_limit'] = $licenseKeyActivationsLimit;

        return $obj;
    }

    /**
     * Duration of the license key if enabled.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the duration in days for which
     * the license key is valid.
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
     * Whether the product requires a license key.
     *
     * If `true`, additional fields related to license key (duration, activations limit, activation message)
     * become applicable.
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
     * @param array<string,string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * Name of the product, optional and must be at most 100 characters.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * Price details of the product.
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
     * }|null $price
     */
    public function withPrice(
        OneTimePrice|array|RecurringPrice|UsageBasedPrice|null $price
    ): self {
        $obj = clone $this;
        $obj['price'] = $price;

        return $obj;
    }

    /**
     * Tax category of the product.
     *
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory
     */
    public function withTaxCategory(TaxCategory|string|null $taxCategory): self
    {
        $obj = clone $this;
        $obj['tax_category'] = $taxCategory;

        return $obj;
    }
}
