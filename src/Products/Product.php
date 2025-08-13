<?php

declare(strict_types=1);

namespace DodoPayments\Products;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Core\Conversion\ListOf;
use DodoPayments\Core\Conversion\MapOf;
use DodoPayments\Misc\TaxCategory;
use DodoPayments\Products\Price\OneTimePrice;
use DodoPayments\Products\Price\RecurringPrice;
use DodoPayments\Products\Product\DigitalProductDelivery;

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
 *   licenseKeyDuration?: LicenseKeyDuration,
 *   name?: string|null,
 * }
 */
final class Product implements BaseModel
{
    use Model;

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
    #[Api(type: new MapOf('string'))]
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
     * @var null|list<string> $addons
     */
    #[Api(type: new ListOf('string'), nullable: true, optional: true)]
    public ?array $addons;

    /**
     * Description of the product, optional.
     */
    #[Api(optional: true)]
    public ?string $description;

    #[Api('digital_product_delivery', optional: true)]
    public ?DigitalProductDelivery $digitalProductDelivery;

    /**
     * URL of the product image, optional.
     */
    #[Api(optional: true)]
    public ?string $image;

    /**
     * Message sent upon license key activation, if applicable.
     */
    #[Api('license_key_activation_message', optional: true)]
    public ?string $licenseKeyActivationMessage;

    /**
     * Limit on the number of activations for the license key, if enabled.
     */
    #[Api('license_key_activations_limit', optional: true)]
    public ?int $licenseKeyActivationsLimit;

    /**
     * Duration of the license key validity, if enabled.
     */
    #[Api('license_key_duration', optional: true)]
    public ?LicenseKeyDuration $licenseKeyDuration;

    /**
     * Name of the product, optional.
     */
    #[Api(optional: true)]
    public ?string $name;

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
     * @param null|list<string> $addons
     */
    public static function from(
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

    public function setBrandID(string $brandID): self
    {
        $this->brandID = $brandID;

        return $this;
    }

    /**
     * Unique identifier for the business to which the product belongs.
     */
    public function setBusinessID(string $businessID): self
    {
        $this->businessID = $businessID;

        return $this;
    }

    /**
     * Timestamp when the product was created.
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Indicates if the product is recurring (e.g., subscriptions).
     */
    public function setIsRecurring(bool $isRecurring): self
    {
        $this->isRecurring = $isRecurring;

        return $this;
    }

    /**
     * Indicates whether the product requires a license key.
     */
    public function setLicenseKeyEnabled(bool $licenseKeyEnabled): self
    {
        $this->licenseKeyEnabled = $licenseKeyEnabled;

        return $this;
    }

    /**
     * Additional custom data associated with the product.
     *
     * @param array<string, string> $metadata
     */
    public function setMetadata(array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Pricing information for the product.
     */
    public function setPrice(OneTimePrice|RecurringPrice $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Unique identifier for the product.
     */
    public function setProductID(string $productID): self
    {
        $this->productID = $productID;

        return $this;
    }

    /**
     * Tax category associated with the product.
     *
     * @param TaxCategory::* $taxCategory
     */
    public function setTaxCategory(string $taxCategory): self
    {
        $this->taxCategory = $taxCategory;

        return $this;
    }

    /**
     * Timestamp when the product was last updated.
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Available Addons for subscription products.
     *
     * @param null|list<string> $addons
     */
    public function setAddons(?array $addons): self
    {
        $this->addons = $addons;

        return $this;
    }

    /**
     * Description of the product, optional.
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setDigitalProductDelivery(
        ?DigitalProductDelivery $digitalProductDelivery
    ): self {
        $this->digitalProductDelivery = $digitalProductDelivery;

        return $this;
    }

    /**
     * URL of the product image, optional.
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Message sent upon license key activation, if applicable.
     */
    public function setLicenseKeyActivationMessage(
        ?string $licenseKeyActivationMessage
    ): self {
        $this->licenseKeyActivationMessage = $licenseKeyActivationMessage;

        return $this;
    }

    /**
     * Limit on the number of activations for the license key, if enabled.
     */
    public function setLicenseKeyActivationsLimit(
        ?int $licenseKeyActivationsLimit
    ): self {
        $this->licenseKeyActivationsLimit = $licenseKeyActivationsLimit;

        return $this;
    }

    /**
     * Duration of the license key validity, if enabled.
     */
    public function setLicenseKeyDuration(
        LicenseKeyDuration $licenseKeyDuration
    ): self {
        $this->licenseKeyDuration = $licenseKeyDuration;

        return $this;
    }

    /**
     * Name of the product, optional.
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
