<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Optional;
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
 *   brandID?: string|null,
 *   description?: string|null,
 *   digitalProductDelivery?: null|DigitalProductDelivery|array{
 *     externalURL?: string|null,
 *     files?: list<string>|null,
 *     instructions?: string|null,
 *   },
 *   imageID?: string|null,
 *   licenseKeyActivationMessage?: string|null,
 *   licenseKeyActivationsLimit?: int|null,
 *   licenseKeyDuration?: null|LicenseKeyDuration|array{
 *     count: int, interval: value-of<TimeInterval>
 *   },
 *   licenseKeyEnabled?: bool|null,
 *   metadata?: array<string,string>|null,
 *   name?: string|null,
 *   price?: null|OneTimePrice|array{
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
 *   taxCategory?: null|TaxCategory|value-of<TaxCategory>,
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
    #[Optional(list: 'string', nullable: true)]
    public ?array $addons;

    #[Optional('brand_id', nullable: true)]
    public ?string $brandID;

    /**
     * Description of the product, optional and must be at most 1000 characters.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Choose how you would like you digital product delivered.
     */
    #[Optional('digital_product_delivery', nullable: true)]
    public ?DigitalProductDelivery $digitalProductDelivery;

    /**
     * Product image id after its uploaded to S3.
     */
    #[Optional('image_id', nullable: true)]
    public ?string $imageID;

    /**
     * Message sent to the customer upon license key activation.
     *
     * Only applicable if `license_key_enabled` is `true`. This message contains instructions for
     * activating the license key.
     */
    #[Optional('license_key_activation_message', nullable: true)]
    public ?string $licenseKeyActivationMessage;

    /**
     * Limit for the number of activations for the license key.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the maximum number of times
     * the license key can be activated.
     */
    #[Optional('license_key_activations_limit', nullable: true)]
    public ?int $licenseKeyActivationsLimit;

    /**
     * Duration of the license key if enabled.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the duration in days for which
     * the license key is valid.
     */
    #[Optional('license_key_duration', nullable: true)]
    public ?LicenseKeyDuration $licenseKeyDuration;

    /**
     * Whether the product requires a license key.
     *
     * If `true`, additional fields related to license key (duration, activations limit, activation message)
     * become applicable.
     */
    #[Optional('license_key_enabled', nullable: true)]
    public ?bool $licenseKeyEnabled;

    /**
     * Additional metadata for the product.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string', nullable: true)]
    public ?array $metadata;

    /**
     * Name of the product, optional and must be at most 100 characters.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * Price details of the product.
     */
    #[Optional(nullable: true)]
    public OneTimePrice|RecurringPrice|UsageBasedPrice|null $price;

    /**
     * Tax category of the product.
     *
     * @var value-of<TaxCategory>|null $taxCategory
     */
    #[Optional('tax_category', enum: TaxCategory::class, nullable: true)]
    public ?string $taxCategory;

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
     *   externalURL?: string|null,
     *   files?: list<string>|null,
     *   instructions?: string|null,
     * }|null $digitalProductDelivery
     * @param LicenseKeyDuration|array{
     *   count: int, interval: value-of<TimeInterval>
     * }|null $licenseKeyDuration
     * @param array<string,string>|null $metadata
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
     * }|null $price
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory
     */
    public static function with(
        ?array $addons = null,
        ?string $brandID = null,
        ?string $description = null,
        DigitalProductDelivery|array|null $digitalProductDelivery = null,
        ?string $imageID = null,
        ?string $licenseKeyActivationMessage = null,
        ?int $licenseKeyActivationsLimit = null,
        LicenseKeyDuration|array|null $licenseKeyDuration = null,
        ?bool $licenseKeyEnabled = null,
        ?array $metadata = null,
        ?string $name = null,
        OneTimePrice|array|RecurringPrice|UsageBasedPrice|null $price = null,
        TaxCategory|string|null $taxCategory = null,
    ): self {
        $self = new self;

        null !== $addons && $self['addons'] = $addons;
        null !== $brandID && $self['brandID'] = $brandID;
        null !== $description && $self['description'] = $description;
        null !== $digitalProductDelivery && $self['digitalProductDelivery'] = $digitalProductDelivery;
        null !== $imageID && $self['imageID'] = $imageID;
        null !== $licenseKeyActivationMessage && $self['licenseKeyActivationMessage'] = $licenseKeyActivationMessage;
        null !== $licenseKeyActivationsLimit && $self['licenseKeyActivationsLimit'] = $licenseKeyActivationsLimit;
        null !== $licenseKeyDuration && $self['licenseKeyDuration'] = $licenseKeyDuration;
        null !== $licenseKeyEnabled && $self['licenseKeyEnabled'] = $licenseKeyEnabled;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $name && $self['name'] = $name;
        null !== $price && $self['price'] = $price;
        null !== $taxCategory && $self['taxCategory'] = $taxCategory;

        return $self;
    }

    /**
     * Available Addons for subscription products.
     *
     * @param list<string>|null $addons
     */
    public function withAddons(?array $addons): self
    {
        $self = clone $this;
        $self['addons'] = $addons;

        return $self;
    }

    public function withBrandID(?string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    /**
     * Description of the product, optional and must be at most 1000 characters.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Choose how you would like you digital product delivered.
     *
     * @param DigitalProductDelivery|array{
     *   externalURL?: string|null,
     *   files?: list<string>|null,
     *   instructions?: string|null,
     * }|null $digitalProductDelivery
     */
    public function withDigitalProductDelivery(
        DigitalProductDelivery|array|null $digitalProductDelivery
    ): self {
        $self = clone $this;
        $self['digitalProductDelivery'] = $digitalProductDelivery;

        return $self;
    }

    /**
     * Product image id after its uploaded to S3.
     */
    public function withImageID(?string $imageID): self
    {
        $self = clone $this;
        $self['imageID'] = $imageID;

        return $self;
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
        $self = clone $this;
        $self['licenseKeyActivationMessage'] = $licenseKeyActivationMessage;

        return $self;
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
        $self = clone $this;
        $self['licenseKeyActivationsLimit'] = $licenseKeyActivationsLimit;

        return $self;
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
        $self = clone $this;
        $self['licenseKeyDuration'] = $licenseKeyDuration;

        return $self;
    }

    /**
     * Whether the product requires a license key.
     *
     * If `true`, additional fields related to license key (duration, activations limit, activation message)
     * become applicable.
     */
    public function withLicenseKeyEnabled(?bool $licenseKeyEnabled): self
    {
        $self = clone $this;
        $self['licenseKeyEnabled'] = $licenseKeyEnabled;

        return $self;
    }

    /**
     * Additional metadata for the product.
     *
     * @param array<string,string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Name of the product, optional and must be at most 100 characters.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Price details of the product.
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
     * }|null $price
     */
    public function withPrice(
        OneTimePrice|array|RecurringPrice|UsageBasedPrice|null $price
    ): self {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * Tax category of the product.
     *
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory
     */
    public function withTaxCategory(TaxCategory|string|null $taxCategory): self
    {
        $self = clone $this;
        $self['taxCategory'] = $taxCategory;

        return $self;
    }
}
