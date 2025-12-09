<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
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
 *     purchasingPowerParity: bool,
 *     type: value-of<Type>,
 *     payWhatYouWant?: bool|null,
 *     suggestedPrice?: int|null,
 *     taxInclusive?: bool|null,
 *   }|RecurringPrice|array{
 *     currency: value-of<Currency>,
 *     discount: int,
 *     paymentFrequencyCount: int,
 *     paymentFrequencyInterval: value-of<TimeInterval>,
 *     price: int,
 *     purchasingPowerParity: bool,
 *     subscriptionPeriodCount: int,
 *     subscriptionPeriodInterval: value-of<TimeInterval>,
 *     type: value-of<\Dodopayments\Products\Price\RecurringPrice\Type>,
 *     taxInclusive?: bool|null,
 *     trialPeriodDays?: int|null,
 *   }|UsageBasedPrice|array{
 *     currency: value-of<Currency>,
 *     discount: int,
 *     fixedPrice: int,
 *     paymentFrequencyCount: int,
 *     paymentFrequencyInterval: value-of<TimeInterval>,
 *     purchasingPowerParity: bool,
 *     subscriptionPeriodCount: int,
 *     subscriptionPeriodInterval: value-of<TimeInterval>,
 *     type: value-of<\Dodopayments\Products\Price\UsageBasedPrice\Type>,
 *     meters?: list<AddMeterToPrice>|null,
 *     taxInclusive?: bool|null,
 *   },
 *   taxCategory: TaxCategory|value-of<TaxCategory>,
 *   addons?: list<string>|null,
 *   brandID?: string|null,
 *   description?: string|null,
 *   digitalProductDelivery?: null|DigitalProductDelivery|array{
 *     externalURL?: string|null, instructions?: string|null
 *   },
 *   licenseKeyActivationMessage?: string|null,
 *   licenseKeyActivationsLimit?: int|null,
 *   licenseKeyDuration?: null|LicenseKeyDuration|array{
 *     count: int, interval: value-of<TimeInterval>
 *   },
 *   licenseKeyEnabled?: bool|null,
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
    #[Required]
    public string $name;

    /**
     * Price configuration for the product.
     */
    #[Required]
    public OneTimePrice|RecurringPrice|UsageBasedPrice $price;

    /**
     * Tax category applied to this product.
     *
     * @var value-of<TaxCategory> $taxCategory
     */
    #[Required('tax_category', enum: TaxCategory::class)]
    public string $taxCategory;

    /**
     * Addons available for subscription product.
     *
     * @var list<string>|null $addons
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $addons;

    /**
     * Brand id for the product, if not provided will default to primary brand.
     */
    #[Optional('brand_id', nullable: true)]
    public ?string $brandID;

    /**
     * Optional description of the product.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Choose how you would like you digital product delivered.
     */
    #[Optional('digital_product_delivery', nullable: true)]
    public ?DigitalProductDelivery $digitalProductDelivery;

    /**
     * Optional message displayed during license key activation.
     */
    #[Optional('license_key_activation_message', nullable: true)]
    public ?string $licenseKeyActivationMessage;

    /**
     * The number of times the license key can be activated.
     * Must be 0 or greater.
     */
    #[Optional('license_key_activations_limit', nullable: true)]
    public ?int $licenseKeyActivationsLimit;

    /**
     * Duration configuration for the license key.
     * Set to null if you don't want the license key to expire.
     * For subscriptions, the lifetime of the license key is tied to the subscription period.
     */
    #[Optional('license_key_duration', nullable: true)]
    public ?LicenseKeyDuration $licenseKeyDuration;

    /**
     * When true, generates and sends a license key to your customer.
     * Defaults to false.
     */
    #[Optional('license_key_enabled', nullable: true)]
    public ?bool $licenseKeyEnabled;

    /**
     * Additional metadata for the product.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * `new ProductCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductCreateParams::with(name: ..., price: ..., taxCategory: ...)
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
     *   purchasingPowerParity: bool,
     *   type: value-of<Type>,
     *   payWhatYouWant?: bool|null,
     *   suggestedPrice?: int|null,
     *   taxInclusive?: bool|null,
     * }|RecurringPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   paymentFrequencyCount: int,
     *   paymentFrequencyInterval: value-of<TimeInterval>,
     *   price: int,
     *   purchasingPowerParity: bool,
     *   subscriptionPeriodCount: int,
     *   subscriptionPeriodInterval: value-of<TimeInterval>,
     *   type: value-of<RecurringPrice\Type>,
     *   taxInclusive?: bool|null,
     *   trialPeriodDays?: int|null,
     * }|UsageBasedPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   fixedPrice: int,
     *   paymentFrequencyCount: int,
     *   paymentFrequencyInterval: value-of<TimeInterval>,
     *   purchasingPowerParity: bool,
     *   subscriptionPeriodCount: int,
     *   subscriptionPeriodInterval: value-of<TimeInterval>,
     *   type: value-of<UsageBasedPrice\Type>,
     *   meters?: list<AddMeterToPrice>|null,
     *   taxInclusive?: bool|null,
     * } $price
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     * @param list<string>|null $addons
     * @param DigitalProductDelivery|array{
     *   externalURL?: string|null, instructions?: string|null
     * }|null $digitalProductDelivery
     * @param LicenseKeyDuration|array{
     *   count: int, interval: value-of<TimeInterval>
     * }|null $licenseKeyDuration
     * @param array<string,string> $metadata
     */
    public static function with(
        string $name,
        OneTimePrice|array|RecurringPrice|UsageBasedPrice $price,
        TaxCategory|string $taxCategory,
        ?array $addons = null,
        ?string $brandID = null,
        ?string $description = null,
        DigitalProductDelivery|array|null $digitalProductDelivery = null,
        ?string $licenseKeyActivationMessage = null,
        ?int $licenseKeyActivationsLimit = null,
        LicenseKeyDuration|array|null $licenseKeyDuration = null,
        ?bool $licenseKeyEnabled = null,
        ?array $metadata = null,
    ): self {
        $obj = new self;

        $obj['name'] = $name;
        $obj['price'] = $price;
        $obj['taxCategory'] = $taxCategory;

        null !== $addons && $obj['addons'] = $addons;
        null !== $brandID && $obj['brandID'] = $brandID;
        null !== $description && $obj['description'] = $description;
        null !== $digitalProductDelivery && $obj['digitalProductDelivery'] = $digitalProductDelivery;
        null !== $licenseKeyActivationMessage && $obj['licenseKeyActivationMessage'] = $licenseKeyActivationMessage;
        null !== $licenseKeyActivationsLimit && $obj['licenseKeyActivationsLimit'] = $licenseKeyActivationsLimit;
        null !== $licenseKeyDuration && $obj['licenseKeyDuration'] = $licenseKeyDuration;
        null !== $licenseKeyEnabled && $obj['licenseKeyEnabled'] = $licenseKeyEnabled;
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
     *   purchasingPowerParity: bool,
     *   type: value-of<Type>,
     *   payWhatYouWant?: bool|null,
     *   suggestedPrice?: int|null,
     *   taxInclusive?: bool|null,
     * }|RecurringPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   paymentFrequencyCount: int,
     *   paymentFrequencyInterval: value-of<TimeInterval>,
     *   price: int,
     *   purchasingPowerParity: bool,
     *   subscriptionPeriodCount: int,
     *   subscriptionPeriodInterval: value-of<TimeInterval>,
     *   type: value-of<RecurringPrice\Type>,
     *   taxInclusive?: bool|null,
     *   trialPeriodDays?: int|null,
     * }|UsageBasedPrice|array{
     *   currency: value-of<Currency>,
     *   discount: int,
     *   fixedPrice: int,
     *   paymentFrequencyCount: int,
     *   paymentFrequencyInterval: value-of<TimeInterval>,
     *   purchasingPowerParity: bool,
     *   subscriptionPeriodCount: int,
     *   subscriptionPeriodInterval: value-of<TimeInterval>,
     *   type: value-of<UsageBasedPrice\Type>,
     *   meters?: list<AddMeterToPrice>|null,
     *   taxInclusive?: bool|null,
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
        $obj['addons'] = $addons;

        return $obj;
    }

    /**
     * Brand id for the product, if not provided will default to primary brand.
     */
    public function withBrandID(?string $brandID): self
    {
        $obj = clone $this;
        $obj['brandID'] = $brandID;

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
     *   externalURL?: string|null, instructions?: string|null
     * }|null $digitalProductDelivery
     */
    public function withDigitalProductDelivery(
        DigitalProductDelivery|array|null $digitalProductDelivery
    ): self {
        $obj = clone $this;
        $obj['digitalProductDelivery'] = $digitalProductDelivery;

        return $obj;
    }

    /**
     * Optional message displayed during license key activation.
     */
    public function withLicenseKeyActivationMessage(
        ?string $licenseKeyActivationMessage
    ): self {
        $obj = clone $this;
        $obj['licenseKeyActivationMessage'] = $licenseKeyActivationMessage;

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
        $obj['licenseKeyActivationsLimit'] = $licenseKeyActivationsLimit;

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
        $obj['licenseKeyDuration'] = $licenseKeyDuration;

        return $obj;
    }

    /**
     * When true, generates and sends a license key to your customer.
     * Defaults to false.
     */
    public function withLicenseKeyEnabled(?bool $licenseKeyEnabled): self
    {
        $obj = clone $this;
        $obj['licenseKeyEnabled'] = $licenseKeyEnabled;

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
