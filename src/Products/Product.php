<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\RecurringPrice;
use Dodopayments\Products\Product\DigitalProductDelivery;

/**
 * @phpstan-type product_alias = array{
 *   brandID: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   isRecurring: bool,
 *   licenseKeyEnabled: bool,
 *   metadata: array<string, string>,
 *   price: OneTimePrice|RecurringPrice,
 *   productID: string,
 *   taxCategory: TaxCategory::*,
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
    /** @use SdkModel<product_alias> */
    use SdkModel;

    #[Api('brand_id')]
    public string $brandID;

    /**
     * Unique identifier for the business to which the product belongs.
     */
    #[Api('business_id')]
    public string $businessID;

    /**
     * Timestamp when the product was created.
     */
    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Indicates if the product is recurring (e.g., subscriptions).
     */
    #[Api('is_recurring')]
    public bool $isRecurring;

    /**
     * Indicates whether the product requires a license key.
     */
    #[Api('license_key_enabled')]
    public bool $licenseKeyEnabled;

    /**
     * Additional custom data associated with the product.
     *
     * @var array<string, string> $metadata
     */
    #[Api(map: 'string')]
    public array $metadata;

    /**
     * Pricing information for the product.
     */
    #[Api]
    public OneTimePrice|RecurringPrice $price;

    /**
     * Unique identifier for the product.
     */
    #[Api('product_id')]
    public string $productID;

    /**
     * Tax category associated with the product.
     *
     * @var TaxCategory::* $taxCategory
     */
    #[Api('tax_category', enum: TaxCategory::class)]
    public string $taxCategory;

    /**
     * Timestamp when the product was last updated.
     */
    #[Api('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Available Addons for subscription products.
     *
     * @var list<string>|null $addons
     */
    #[Api(list: 'string', nullable: true, optional: true)]
    public ?array $addons;

    /**
     * Description of the product, optional.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $description;

    #[Api('digital_product_delivery', nullable: true, optional: true)]
    public ?DigitalProductDelivery $digitalProductDelivery;

    /**
     * URL of the product image, optional.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $image;

    /**
     * Message sent upon license key activation, if applicable.
     */
    #[Api('license_key_activation_message', nullable: true, optional: true)]
    public ?string $licenseKeyActivationMessage;

    /**
     * Limit on the number of activations for the license key, if enabled.
     */
    #[Api('license_key_activations_limit', nullable: true, optional: true)]
    public ?int $licenseKeyActivationsLimit;

    /**
     * Duration of the license key validity, if enabled.
     */
    #[Api('license_key_duration', nullable: true, optional: true)]
    public ?LicenseKeyDuration $licenseKeyDuration;

    /**
     * Name of the product, optional.
     */
    #[Api(nullable: true, optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string, string> $metadata
     * @param TaxCategory::* $taxCategory
     * @param list<string>|null $addons
     */
    public static function with(
        string $brandID,
        string $businessID,
        \DateTimeInterface $createdAt,
        bool $isRecurring,
        bool $licenseKeyEnabled,
        array $metadata,
        OneTimePrice|RecurringPrice $price,
        string $productID,
        string $taxCategory,
        \DateTimeInterface $updatedAt,
        ?array $addons = null,
        ?string $description = null,
        ?DigitalProductDelivery $digitalProductDelivery = null,
        ?string $image = null,
        ?string $licenseKeyActivationMessage = null,
        ?int $licenseKeyActivationsLimit = null,
        ?LicenseKeyDuration $licenseKeyDuration = null,
        ?string $name = null,
    ): self {
        $obj = new self;

        $obj->brandID = $brandID;
        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->isRecurring = $isRecurring;
        $obj->licenseKeyEnabled = $licenseKeyEnabled;
        $obj->metadata = $metadata;
        $obj->price = $price;
        $obj->productID = $productID;
        $obj->taxCategory = $taxCategory;
        $obj->updatedAt = $updatedAt;

        null !== $addons && $obj->addons = $addons;
        null !== $description && $obj->description = $description;
        null !== $digitalProductDelivery && $obj->digitalProductDelivery = $digitalProductDelivery;
        null !== $image && $obj->image = $image;
        null !== $licenseKeyActivationMessage && $obj->licenseKeyActivationMessage = $licenseKeyActivationMessage;
        null !== $licenseKeyActivationsLimit && $obj->licenseKeyActivationsLimit = $licenseKeyActivationsLimit;
        null !== $licenseKeyDuration && $obj->licenseKeyDuration = $licenseKeyDuration;
        null !== $name && $obj->name = $name;

        return $obj;
    }

    public function withBrandID(string $brandID): self
    {
        $obj = clone $this;
        $obj->brandID = $brandID;

        return $obj;
    }

    /**
     * Unique identifier for the business to which the product belongs.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    /**
     * Timestamp when the product was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * Indicates if the product is recurring (e.g., subscriptions).
     */
    public function withIsRecurring(bool $isRecurring): self
    {
        $obj = clone $this;
        $obj->isRecurring = $isRecurring;

        return $obj;
    }

    /**
     * Indicates whether the product requires a license key.
     */
    public function withLicenseKeyEnabled(bool $licenseKeyEnabled): self
    {
        $obj = clone $this;
        $obj->licenseKeyEnabled = $licenseKeyEnabled;

        return $obj;
    }

    /**
     * Additional custom data associated with the product.
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
     * Pricing information for the product.
     */
    public function withPrice(OneTimePrice|RecurringPrice $price): self
    {
        $obj = clone $this;
        $obj->price = $price;

        return $obj;
    }

    /**
     * Unique identifier for the product.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj->productID = $productID;

        return $obj;
    }

    /**
     * Tax category associated with the product.
     *
     * @param TaxCategory::* $taxCategory
     */
    public function withTaxCategory(string $taxCategory): self
    {
        $obj = clone $this;
        $obj->taxCategory = $taxCategory;

        return $obj;
    }

    /**
     * Timestamp when the product was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj->updatedAt = $updatedAt;

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
        $obj->addons = $addons;

        return $obj;
    }

    /**
     * Description of the product, optional.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    public function withDigitalProductDelivery(
        ?DigitalProductDelivery $digitalProductDelivery
    ): self {
        $obj = clone $this;
        $obj->digitalProductDelivery = $digitalProductDelivery;

        return $obj;
    }

    /**
     * URL of the product image, optional.
     */
    public function withImage(?string $image): self
    {
        $obj = clone $this;
        $obj->image = $image;

        return $obj;
    }

    /**
     * Message sent upon license key activation, if applicable.
     */
    public function withLicenseKeyActivationMessage(
        ?string $licenseKeyActivationMessage
    ): self {
        $obj = clone $this;
        $obj->licenseKeyActivationMessage = $licenseKeyActivationMessage;

        return $obj;
    }

    /**
     * Limit on the number of activations for the license key, if enabled.
     */
    public function withLicenseKeyActivationsLimit(
        ?int $licenseKeyActivationsLimit
    ): self {
        $obj = clone $this;
        $obj->licenseKeyActivationsLimit = $licenseKeyActivationsLimit;

        return $obj;
    }

    /**
     * Duration of the license key validity, if enabled.
     */
    public function withLicenseKeyDuration(
        LicenseKeyDuration $licenseKeyDuration
    ): self {
        $obj = clone $this;
        $obj->licenseKeyDuration = $licenseKeyDuration;

        return $obj;
    }

    /**
     * Name of the product, optional.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }
}
