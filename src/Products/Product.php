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
 *   brandID: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   isRecurring: bool,
 *   licenseKeyEnabled: bool,
 *   metadata: array<string,string>,
 *   price: OneTimePrice|RecurringPrice|UsageBasedPrice,
 *   productID: string,
 *   taxCategory: value-of<TaxCategory>,
 *   updatedAt: \DateTimeInterface,
 *   addons?: list<string>|null,
 *   description?: string|null,
 *   digitalProductDelivery?: DigitalProductDelivery|null,
 *   image?: string|null,
 *   licenseKeyActivationMessage?: string|null,
 *   licenseKeyActivationsLimit?: int|null,
 *   licenseKeyDuration?: LicenseKeyDuration|null,
 *   name?: string|null,
 * }
 */
final class Product implements BaseModel
{
    /** @use SdkModel<ProductShape> */
    use SdkModel;

    #[Required('brand_id')]
    public string $brandID;

    /**
     * Unique identifier for the business to which the product belongs.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * Timestamp when the product was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Indicates if the product is recurring (e.g., subscriptions).
     */
    #[Required('is_recurring')]
    public bool $isRecurring;

    /**
     * Indicates whether the product requires a license key.
     */
    #[Required('license_key_enabled')]
    public bool $licenseKeyEnabled;

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
    #[Required('product_id')]
    public string $productID;

    /**
     * Tax category associated with the product.
     *
     * @var value-of<TaxCategory> $taxCategory
     */
    #[Required('tax_category', enum: TaxCategory::class)]
    public string $taxCategory;

    /**
     * Timestamp when the product was last updated.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

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

    #[Optional('digital_product_delivery', nullable: true)]
    public ?DigitalProductDelivery $digitalProductDelivery;

    /**
     * URL of the product image, optional.
     */
    #[Optional(nullable: true)]
    public ?string $image;

    /**
     * Message sent upon license key activation, if applicable.
     */
    #[Optional('license_key_activation_message', nullable: true)]
    public ?string $licenseKeyActivationMessage;

    /**
     * Limit on the number of activations for the license key, if enabled.
     */
    #[Optional('license_key_activations_limit', nullable: true)]
    public ?int $licenseKeyActivationsLimit;

    /**
     * Duration of the license key validity, if enabled.
     */
    #[Optional('license_key_duration', nullable: true)]
    public ?LicenseKeyDuration $licenseKeyDuration;

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
     *   brandID: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   isRecurring: ...,
     *   licenseKeyEnabled: ...,
     *   metadata: ...,
     *   price: ...,
     *   productID: ...,
     *   taxCategory: ...,
     *   updatedAt: ...,
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
     *   externalURL?: string|null, files?: list<File>|null, instructions?: string|null
     * }|null $digitalProductDelivery
     * @param LicenseKeyDuration|array{
     *   count: int, interval: value-of<TimeInterval>
     * }|null $licenseKeyDuration
     */
    public static function with(
        string $brandID,
        string $businessID,
        \DateTimeInterface $createdAt,
        bool $isRecurring,
        bool $licenseKeyEnabled,
        array $metadata,
        OneTimePrice|array|RecurringPrice|UsageBasedPrice $price,
        string $productID,
        TaxCategory|string $taxCategory,
        \DateTimeInterface $updatedAt,
        ?array $addons = null,
        ?string $description = null,
        DigitalProductDelivery|array|null $digitalProductDelivery = null,
        ?string $image = null,
        ?string $licenseKeyActivationMessage = null,
        ?int $licenseKeyActivationsLimit = null,
        LicenseKeyDuration|array|null $licenseKeyDuration = null,
        ?string $name = null,
    ): self {
        $obj = new self;

        $obj['brandID'] = $brandID;
        $obj['businessID'] = $businessID;
        $obj['createdAt'] = $createdAt;
        $obj['isRecurring'] = $isRecurring;
        $obj['licenseKeyEnabled'] = $licenseKeyEnabled;
        $obj['metadata'] = $metadata;
        $obj['price'] = $price;
        $obj['productID'] = $productID;
        $obj['taxCategory'] = $taxCategory;
        $obj['updatedAt'] = $updatedAt;

        null !== $addons && $obj['addons'] = $addons;
        null !== $description && $obj['description'] = $description;
        null !== $digitalProductDelivery && $obj['digitalProductDelivery'] = $digitalProductDelivery;
        null !== $image && $obj['image'] = $image;
        null !== $licenseKeyActivationMessage && $obj['licenseKeyActivationMessage'] = $licenseKeyActivationMessage;
        null !== $licenseKeyActivationsLimit && $obj['licenseKeyActivationsLimit'] = $licenseKeyActivationsLimit;
        null !== $licenseKeyDuration && $obj['licenseKeyDuration'] = $licenseKeyDuration;
        null !== $name && $obj['name'] = $name;

        return $obj;
    }

    public function withBrandID(string $brandID): self
    {
        $obj = clone $this;
        $obj['brandID'] = $brandID;

        return $obj;
    }

    /**
     * Unique identifier for the business to which the product belongs.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['businessID'] = $businessID;

        return $obj;
    }

    /**
     * Timestamp when the product was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    /**
     * Indicates if the product is recurring (e.g., subscriptions).
     */
    public function withIsRecurring(bool $isRecurring): self
    {
        $obj = clone $this;
        $obj['isRecurring'] = $isRecurring;

        return $obj;
    }

    /**
     * Indicates whether the product requires a license key.
     */
    public function withLicenseKeyEnabled(bool $licenseKeyEnabled): self
    {
        $obj = clone $this;
        $obj['licenseKeyEnabled'] = $licenseKeyEnabled;

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
     * Unique identifier for the product.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj['productID'] = $productID;

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
        $obj['taxCategory'] = $taxCategory;

        return $obj;
    }

    /**
     * Timestamp when the product was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj['updatedAt'] = $updatedAt;

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
     *   externalURL?: string|null, files?: list<File>|null, instructions?: string|null
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
        $obj['licenseKeyActivationMessage'] = $licenseKeyActivationMessage;

        return $obj;
    }

    /**
     * Limit on the number of activations for the license key, if enabled.
     */
    public function withLicenseKeyActivationsLimit(
        ?int $licenseKeyActivationsLimit
    ): self {
        $obj = clone $this;
        $obj['licenseKeyActivationsLimit'] = $licenseKeyActivationsLimit;

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
        $obj['licenseKeyDuration'] = $licenseKeyDuration;

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
