<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\RecurringPrice;
use Dodopayments\Products\Price\UsageBasedPrice;
use Dodopayments\Products\ProductUpdateParams\DigitalProductDelivery;

/**
 * @see Dodopayments\Products->update
 *
 * @phpstan-type ProductUpdateParamsShape = array{
 *   addons?: list<string>|null,
 *   brandID?: string|null,
 *   description?: string|null,
 *   digitalProductDelivery?: DigitalProductDelivery|null,
 *   imageID?: string|null,
 *   licenseKeyActivationMessage?: string|null,
 *   licenseKeyActivationsLimit?: int|null,
 *   licenseKeyDuration?: LicenseKeyDuration|null,
 *   licenseKeyEnabled?: bool|null,
 *   metadata?: array<string, string>|null,
 *   name?: string|null,
 *   price?: null|OneTimePrice|RecurringPrice|UsageBasedPrice,
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
    #[Api(list: 'string', nullable: true, optional: true)]
    public ?array $addons;

    #[Api('brand_id', nullable: true, optional: true)]
    public ?string $brandID;

    /**
     * Description of the product, optional and must be at most 1000 characters.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $description;

    /**
     * Choose how you would like you digital product delivered.
     */
    #[Api('digital_product_delivery', nullable: true, optional: true)]
    public ?DigitalProductDelivery $digitalProductDelivery;

    /**
     * Product image id after its uploaded to S3.
     */
    #[Api('image_id', nullable: true, optional: true)]
    public ?string $imageID;

    /**
     * Message sent to the customer upon license key activation.
     *
     * Only applicable if `license_key_enabled` is `true`. This message contains instructions for
     * activating the license key.
     */
    #[Api('license_key_activation_message', nullable: true, optional: true)]
    public ?string $licenseKeyActivationMessage;

    /**
     * Limit for the number of activations for the license key.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the maximum number of times
     * the license key can be activated.
     */
    #[Api('license_key_activations_limit', nullable: true, optional: true)]
    public ?int $licenseKeyActivationsLimit;

    /**
     * Duration of the license key if enabled.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the duration in days for which
     * the license key is valid.
     */
    #[Api('license_key_duration', nullable: true, optional: true)]
    public ?LicenseKeyDuration $licenseKeyDuration;

    /**
     * Whether the product requires a license key.
     *
     * If `true`, additional fields related to license key (duration, activations limit, activation message)
     * become applicable.
     */
    #[Api('license_key_enabled', nullable: true, optional: true)]
    public ?bool $licenseKeyEnabled;

    /**
     * Additional metadata for the product.
     *
     * @var array<string, string>|null $metadata
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
     * @var value-of<TaxCategory>|null $taxCategory
     */
    #[Api(
        'tax_category',
        enum: TaxCategory::class,
        nullable: true,
        optional: true
    )]
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
     * @param array<string, string>|null $metadata
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory
     */
    public static function with(
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
        OneTimePrice|RecurringPrice|UsageBasedPrice|null $price = null,
        TaxCategory|string|null $taxCategory = null,
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
        null !== $taxCategory && $obj['taxCategory'] = $taxCategory;

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

    public function withBrandID(?string $brandID): self
    {
        $obj = clone $this;
        $obj->brandID = $brandID;

        return $obj;
    }

    /**
     * Description of the product, optional and must be at most 1000 characters.
     */
    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    /**
     * Choose how you would like you digital product delivered.
     */
    public function withDigitalProductDelivery(
        ?DigitalProductDelivery $digitalProductDelivery
    ): self {
        $obj = clone $this;
        $obj->digitalProductDelivery = $digitalProductDelivery;

        return $obj;
    }

    /**
     * Product image id after its uploaded to S3.
     */
    public function withImageID(?string $imageID): self
    {
        $obj = clone $this;
        $obj->imageID = $imageID;

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
        $obj->licenseKeyActivationMessage = $licenseKeyActivationMessage;

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
        $obj->licenseKeyActivationsLimit = $licenseKeyActivationsLimit;

        return $obj;
    }

    /**
     * Duration of the license key if enabled.
     *
     * Only applicable if `license_key_enabled` is `true`. Represents the duration in days for which
     * the license key is valid.
     */
    public function withLicenseKeyDuration(
        ?LicenseKeyDuration $licenseKeyDuration
    ): self {
        $obj = clone $this;
        $obj->licenseKeyDuration = $licenseKeyDuration;

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
        $obj->licenseKeyEnabled = $licenseKeyEnabled;

        return $obj;
    }

    /**
     * Additional metadata for the product.
     *
     * @param array<string, string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * Name of the product, optional and must be at most 100 characters.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Price details of the product.
     */
    public function withPrice(
        OneTimePrice|RecurringPrice|UsageBasedPrice|null $price
    ): self {
        $obj = clone $this;
        $obj->price = $price;

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
        $obj['taxCategory'] = $taxCategory;

        return $obj;
    }
}
