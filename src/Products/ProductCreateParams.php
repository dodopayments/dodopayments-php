<?php

declare(strict_types=1);

namespace DodoPayments\Products;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Core\Conversion\ListOf;
use DodoPayments\Core\Conversion\MapOf;
use DodoPayments\Misc\TaxCategory;
use DodoPayments\Products\Price\OneTimePrice;
use DodoPayments\Products\Price\RecurringPrice;
use DodoPayments\Products\ProductCreateParams\DigitalProductDelivery;

/**
 * @phpstan-type create_params = array{
 *   price: OneTimePrice|RecurringPrice,
 *   taxCategory: TaxCategory::*,
 *   addons?: list<string>|null,
 *   brandID?: string|null,
 *   description?: string|null,
 *   digitalProductDelivery?: DigitalProductDelivery|null,
 *   licenseKeyActivationMessage?: string|null,
 *   licenseKeyActivationsLimit?: int|null,
 *   licenseKeyDuration?: LicenseKeyDuration,
 *   licenseKeyEnabled?: bool|null,
 *   metadata?: array<string, string>,
 *   name?: string|null,
 * }
 */
final class ProductCreateParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Price configuration for the product.
     */
    #[Api]
    public OneTimePrice|RecurringPrice $price;

    /**
     * Tax category applied to this product.
     *
     * @var TaxCategory::* $taxCategory
     */
    #[Api('tax_category', enum: TaxCategory::class)]
    public string $taxCategory;

    /**
     * Addons available for subscription product.
     *
     * @var null|list<string> $addons
     */
    #[Api(type: new ListOf('string'), nullable: true, optional: true)]
    public ?array $addons;

    /**
     * Brand id for the product, if not provided will default to primary brand.
     */
    #[Api('brand_id', optional: true)]
    public ?string $brandID;

    /**
     * Optional description of the product.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * Choose how you would like you digital product delivered.
     */
    #[Api('digital_product_delivery', optional: true)]
    public ?DigitalProductDelivery $digitalProductDelivery;

    /**
     * Optional message displayed during license key activation.
     */
    #[Api('license_key_activation_message', optional: true)]
    public ?string $licenseKeyActivationMessage;

    /**
     * The number of times the license key can be activated.
     * Must be 0 or greater.
     */
    #[Api('license_key_activations_limit', optional: true)]
    public ?int $licenseKeyActivationsLimit;

    /**
     * Duration configuration for the license key.
     * Set to null if you don't want the license key to expire.
     * For subscriptions, the lifetime of the license key is tied to the subscription period.
     */
    #[Api('license_key_duration', optional: true)]
    public ?LicenseKeyDuration $licenseKeyDuration;

    /**
     * When true, generates and sends a license key to your customer.
     * Defaults to false.
     */
    #[Api('license_key_enabled', optional: true)]
    public ?bool $licenseKeyEnabled;

    /**
     * Additional metadata for the product.
     *
     * @var null|array<string, string> $metadata
     */
    #[Api(type: new MapOf('string'), optional: true)]
    public ?array $metadata;

    /**
     * Optional name of the product.
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
     * @param TaxCategory::* $taxCategory
     * @param null|list<string> $addons
     * @param null|array<string, string> $metadata
     */
    public static function from(
        OneTimePrice|RecurringPrice $price,
        string $taxCategory,
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
        $obj->taxCategory = $taxCategory;

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
    public function setPrice(OneTimePrice|RecurringPrice $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Tax category applied to this product.
     *
     * @param TaxCategory::* $taxCategory
     */
    public function setTaxCategory(string $taxCategory): self
    {
        $this->taxCategory = $taxCategory;

        return $this;
    }

    /**
     * Addons available for subscription product.
     *
     * @param null|list<string> $addons
     */
    public function setAddons(?array $addons): self
    {
        $this->addons = $addons;

        return $this;
    }

    /**
     * Brand id for the product, if not provided will default to primary brand.
     */
    public function setBrandID(?string $brandID): self
    {
        $this->brandID = $brandID;

        return $this;
    }

    /**
     * Optional description of the product.
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Choose how you would like you digital product delivered.
     */
    public function setDigitalProductDelivery(
        ?DigitalProductDelivery $digitalProductDelivery
    ): self {
        $this->digitalProductDelivery = $digitalProductDelivery;

        return $this;
    }

    /**
     * Optional message displayed during license key activation.
     */
    public function setLicenseKeyActivationMessage(
        ?string $licenseKeyActivationMessage
    ): self {
        $this->licenseKeyActivationMessage = $licenseKeyActivationMessage;

        return $this;
    }

    /**
     * The number of times the license key can be activated.
     * Must be 0 or greater.
     */
    public function setLicenseKeyActivationsLimit(
        ?int $licenseKeyActivationsLimit
    ): self {
        $this->licenseKeyActivationsLimit = $licenseKeyActivationsLimit;

        return $this;
    }

    /**
     * Duration configuration for the license key.
     * Set to null if you don't want the license key to expire.
     * For subscriptions, the lifetime of the license key is tied to the subscription period.
     */
    public function setLicenseKeyDuration(
        LicenseKeyDuration $licenseKeyDuration
    ): self {
        $this->licenseKeyDuration = $licenseKeyDuration;

        return $this;
    }

    /**
     * When true, generates and sends a license key to your customer.
     * Defaults to false.
     */
    public function setLicenseKeyEnabled(?bool $licenseKeyEnabled): self
    {
        $this->licenseKeyEnabled = $licenseKeyEnabled;

        return $this;
    }

    /**
     * Additional metadata for the product.
     *
     * @param array<string, string> $metadata
     */
    public function setMetadata(array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Optional name of the product.
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
