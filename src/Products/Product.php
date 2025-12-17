<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\RecurringPrice;
use Dodopayments\Products\Price\UsageBasedPrice;
use Dodopayments\Products\Product\DigitalProductDelivery;

/**
 * @phpstan-import-type PriceShape from \Dodopayments\Products\Price
 * @phpstan-import-type DigitalProductDeliveryShape from \Dodopayments\Products\Product\DigitalProductDelivery
 * @phpstan-import-type LicenseKeyDurationShape from \Dodopayments\Products\LicenseKeyDuration
 *
 * @phpstan-type ProductShape = array{
 *   brandID: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   isRecurring: bool,
 *   licenseKeyEnabled: bool,
 *   metadata: array<string,string>,
 *   price: OneTimePrice|RecurringPrice|UsageBasedPrice|PriceShape,
 *   productID: string,
 *   taxCategory: TaxCategory|value-of<TaxCategory>,
 *   updatedAt: \DateTimeInterface,
 *   addons?: list<string>|null,
 *   description?: string|null,
 *   digitalProductDelivery?: null|DigitalProductDelivery|DigitalProductDeliveryShape,
 *   image?: string|null,
 *   licenseKeyActivationMessage?: string|null,
 *   licenseKeyActivationsLimit?: int|null,
 *   licenseKeyDuration?: null|LicenseKeyDuration|LicenseKeyDurationShape,
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
     * @param PriceShape $price
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     * @param list<string>|null $addons
     * @param DigitalProductDeliveryShape|null $digitalProductDelivery
     * @param LicenseKeyDurationShape|null $licenseKeyDuration
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
        $self = new self;

        $self['brandID'] = $brandID;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['isRecurring'] = $isRecurring;
        $self['licenseKeyEnabled'] = $licenseKeyEnabled;
        $self['metadata'] = $metadata;
        $self['price'] = $price;
        $self['productID'] = $productID;
        $self['taxCategory'] = $taxCategory;
        $self['updatedAt'] = $updatedAt;

        null !== $addons && $self['addons'] = $addons;
        null !== $description && $self['description'] = $description;
        null !== $digitalProductDelivery && $self['digitalProductDelivery'] = $digitalProductDelivery;
        null !== $image && $self['image'] = $image;
        null !== $licenseKeyActivationMessage && $self['licenseKeyActivationMessage'] = $licenseKeyActivationMessage;
        null !== $licenseKeyActivationsLimit && $self['licenseKeyActivationsLimit'] = $licenseKeyActivationsLimit;
        null !== $licenseKeyDuration && $self['licenseKeyDuration'] = $licenseKeyDuration;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    public function withBrandID(string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    /**
     * Unique identifier for the business to which the product belongs.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * Timestamp when the product was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Indicates if the product is recurring (e.g., subscriptions).
     */
    public function withIsRecurring(bool $isRecurring): self
    {
        $self = clone $this;
        $self['isRecurring'] = $isRecurring;

        return $self;
    }

    /**
     * Indicates whether the product requires a license key.
     */
    public function withLicenseKeyEnabled(bool $licenseKeyEnabled): self
    {
        $self = clone $this;
        $self['licenseKeyEnabled'] = $licenseKeyEnabled;

        return $self;
    }

    /**
     * Additional custom data associated with the product.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Pricing information for the product.
     *
     * @param PriceShape $price
     */
    public function withPrice(
        OneTimePrice|array|RecurringPrice|UsageBasedPrice $price
    ): self {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * Unique identifier for the product.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * Tax category associated with the product.
     *
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     */
    public function withTaxCategory(TaxCategory|string $taxCategory): self
    {
        $self = clone $this;
        $self['taxCategory'] = $taxCategory;

        return $self;
    }

    /**
     * Timestamp when the product was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

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

    /**
     * Description of the product, optional.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * @param DigitalProductDeliveryShape|null $digitalProductDelivery
     */
    public function withDigitalProductDelivery(
        DigitalProductDelivery|array|null $digitalProductDelivery
    ): self {
        $self = clone $this;
        $self['digitalProductDelivery'] = $digitalProductDelivery;

        return $self;
    }

    /**
     * URL of the product image, optional.
     */
    public function withImage(?string $image): self
    {
        $self = clone $this;
        $self['image'] = $image;

        return $self;
    }

    /**
     * Message sent upon license key activation, if applicable.
     */
    public function withLicenseKeyActivationMessage(
        ?string $licenseKeyActivationMessage
    ): self {
        $self = clone $this;
        $self['licenseKeyActivationMessage'] = $licenseKeyActivationMessage;

        return $self;
    }

    /**
     * Limit on the number of activations for the license key, if enabled.
     */
    public function withLicenseKeyActivationsLimit(
        ?int $licenseKeyActivationsLimit
    ): self {
        $self = clone $this;
        $self['licenseKeyActivationsLimit'] = $licenseKeyActivationsLimit;

        return $self;
    }

    /**
     * Duration of the license key validity, if enabled.
     *
     * @param LicenseKeyDurationShape|null $licenseKeyDuration
     */
    public function withLicenseKeyDuration(
        LicenseKeyDuration|array|null $licenseKeyDuration
    ): self {
        $self = clone $this;
        $self['licenseKeyDuration'] = $licenseKeyDuration;

        return $self;
    }

    /**
     * Name of the product, optional.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
