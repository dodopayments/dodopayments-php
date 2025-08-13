<?php

declare(strict_types=1);

namespace DodopaymentsClient\Products;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Concerns\Params;
use DodopaymentsClient\Core\Contracts\BaseModel;
use DodopaymentsClient\Core\Conversion\ListOf;
use DodopaymentsClient\Core\Conversion\MapOf;
use DodopaymentsClient\Misc\TaxCategory;
use DodopaymentsClient\Products\Price\OneTimePrice;
use DodopaymentsClient\Products\Price\RecurringPrice;
use DodopaymentsClient\Products\ProductUpdateParams\DigitalProductDelivery;

/**
 * @phpstan-type update_params = array{
 *   addons?: list<string>|null,
 *   brandID?: string|null,
 *   description?: string|null,
 *   digitalProductDelivery?: DigitalProductDelivery|null,
 *   imageID?: string|null,
 *   licenseKeyActivationMessage?: string|null,
 *   licenseKeyActivationsLimit?: int|null,
 *   licenseKeyDuration?: LicenseKeyDuration,
 *   licenseKeyEnabled?: bool|null,
 *   metadata?: array<string, string>|null,
 *   name?: string|null,
 *   price?: OneTimePrice|RecurringPrice,
 *   taxCategory?: TaxCategory::*,
 * }
 */
final class ProductUpdateParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Available Addons for subscription products.
     *
     * @var null|list<string> $addons
     */
    #[Api(type: new ListOf('string'), nullable: true, optional: true)]
    public ?array $addons;

    #[Api('brand_id', optional: true)]
    public ?string $brandID;

    /**
     * Description of the product, optional and must be at most 1000 characters.
     */
    #[Api(optional: true)]
    public ?string $description;

    /**
     * Choose how you would like you digital product delivered.
     */
    #[Api('digital_product_delivery', optional: true)]
    public ?DigitalProductDelivery $digitalProductDelivery;

    /**
     * Product image id after its uploaded to S3.
     */
    #[Api('image_id', optional: true)]
    public ?string $imageID;

    /**
     * Message sent to the customer upon license key activation.
     *
     * Only applicable if `license_key_enabled` is `true`. This message contains instructions for
     * activating the license key.
     */
    #[Api('license_key_activation_message', optional: true)]
    public ?string $licenseKeyActivationMessage;

    /**
     * Limit for the number of activations for the license key.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the maximum number of times
     * the license key can be activated.
     */
    #[Api('license_key_activations_limit', optional: true)]
    public ?int $licenseKeyActivationsLimit;

    /**
     * Duration of the license key if enabled.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the duration in days for which
     * the license key is valid.
     */
    #[Api('license_key_duration', optional: true)]
    public ?LicenseKeyDuration $licenseKeyDuration;

    /**
     * Whether the product requires a license key.
     *
     * If `true`, additional fields related to license key (duration, activations limit, activation message)
     * become applicable.
     */
    #[Api('license_key_enabled', optional: true)]
    public ?bool $licenseKeyEnabled;

    /**
     * Additional metadata for the product.
     *
     * @var null|array<string, string> $metadata
     */
    #[Api(type: new MapOf('string'), nullable: true, optional: true)]
    public ?array $metadata;

    /**
     * Name of the product, optional and must be at most 100 characters.
     */
    #[Api(optional: true)]
    public ?string $name;

    /**
     * Price details of the product.
     */
    #[Api(optional: true)]
    public null|OneTimePrice|RecurringPrice $price;

    /**
     * Tax category of the product.
     *
     * @var null|TaxCategory::* $taxCategory
     */
    #[Api('tax_category', enum: TaxCategory::class, optional: true)]
    public ?string $taxCategory;

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
     * @param null|list<string> $addons
     * @param null|array<string, string> $metadata
     * @param TaxCategory::* $taxCategory
     */
    public static function from(
        ?array $addons = null,
        ?string $brandID = null,
        ?string $description = null,
        ?DigitalProductDelivery $digitalProductDelivery = null,
        ?string $imageID = null,
        ?string $licenseKeyActivationMessage = null,
        ?int $licenseKeyActivationsLimit = null,
        ?LicenseKeyDuration $licenseKeyDuration = null,
        ?bool $licenseKeyEnabled = null,
        ?array $metadata = null,
        ?string $name = null,
        null|OneTimePrice|RecurringPrice $price = null,
        ?string $taxCategory = null,
    ): self {
        $obj = new self;

        null !== $addons && $obj->addons = $addons;
        null !== $brandID && $obj->brandID = $brandID;
        null !== $description && $obj->description = $description;
        null !== $digitalProductDelivery && $obj->digitalProductDelivery = $digitalProductDelivery;
        null !== $imageID && $obj->imageID = $imageID;
        null !== $licenseKeyActivationMessage && $obj->licenseKeyActivationMessage = $licenseKeyActivationMessage;
        null !== $licenseKeyActivationsLimit && $obj->licenseKeyActivationsLimit = $licenseKeyActivationsLimit;
        null !== $licenseKeyDuration && $obj->licenseKeyDuration = $licenseKeyDuration;
        null !== $licenseKeyEnabled && $obj->licenseKeyEnabled = $licenseKeyEnabled;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $name && $obj->name = $name;
        null !== $price && $obj->price = $price;
        null !== $taxCategory && $obj->taxCategory = $taxCategory;

        return $obj;
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

    public function setBrandID(?string $brandID): self
    {
        $this->brandID = $brandID;

        return $this;
    }

    /**
     * Description of the product, optional and must be at most 1000 characters.
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
     * Product image id after its uploaded to S3.
     */
    public function setImageID(?string $imageID): self
    {
        $this->imageID = $imageID;

        return $this;
    }

    /**
     * Message sent to the customer upon license key activation.
     *
     * Only applicable if `license_key_enabled` is `true`. This message contains instructions for
     * activating the license key.
     */
    public function setLicenseKeyActivationMessage(
        ?string $licenseKeyActivationMessage
    ): self {
        $this->licenseKeyActivationMessage = $licenseKeyActivationMessage;

        return $this;
    }

    /**
     * Limit for the number of activations for the license key.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the maximum number of times
     * the license key can be activated.
     */
    public function setLicenseKeyActivationsLimit(
        ?int $licenseKeyActivationsLimit
    ): self {
        $this->licenseKeyActivationsLimit = $licenseKeyActivationsLimit;

        return $this;
    }

    /**
     * Duration of the license key if enabled.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the duration in days for which
     * the license key is valid.
     */
    public function setLicenseKeyDuration(
        LicenseKeyDuration $licenseKeyDuration
    ): self {
        $this->licenseKeyDuration = $licenseKeyDuration;

        return $this;
    }

    /**
     * Whether the product requires a license key.
     *
     * If `true`, additional fields related to license key (duration, activations limit, activation message)
     * become applicable.
     */
    public function setLicenseKeyEnabled(?bool $licenseKeyEnabled): self
    {
        $this->licenseKeyEnabled = $licenseKeyEnabled;

        return $this;
    }

    /**
     * Additional metadata for the product.
     *
     * @param null|array<string, string> $metadata
     */
    public function setMetadata(?array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Name of the product, optional and must be at most 100 characters.
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Price details of the product.
     */
    public function setPrice(OneTimePrice|RecurringPrice $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Tax category of the product.
     *
     * @param TaxCategory::* $taxCategory
     */
    public function setTaxCategory(string $taxCategory): self
    {
        $this->taxCategory = $taxCategory;

        return $this;
    }
}
