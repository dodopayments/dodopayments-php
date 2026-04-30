<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\RecurringPrice;
use Dodopayments\Products\Price\UsageBasedPrice;
use Dodopayments\Products\ProductCreateParams\DigitalProductDelivery;

/**
 * @see Dodopayments\Services\ProductsService::create()
 *
 * @phpstan-import-type PriceVariants from \Dodopayments\Products\Price
 * @phpstan-import-type PriceShape from \Dodopayments\Products\Price
 * @phpstan-import-type AttachCreditEntitlementShape from \Dodopayments\Products\AttachCreditEntitlement
 * @phpstan-import-type DigitalProductDeliveryShape from \Dodopayments\Products\ProductCreateParams\DigitalProductDelivery
 * @phpstan-import-type AttachProductEntitlementShape from \Dodopayments\Products\AttachProductEntitlement
 * @phpstan-import-type LicenseKeyDurationShape from \Dodopayments\Products\LicenseKeyDuration
 *
 * @phpstan-type ProductCreateParamsShape = array{
 *   name: string,
 *   price: PriceShape,
 *   taxCategory: TaxCategory|value-of<TaxCategory>,
 *   addons?: list<string>|null,
 *   brandID?: string|null,
 *   creditEntitlements?: list<AttachCreditEntitlement|AttachCreditEntitlementShape>|null,
 *   description?: string|null,
 *   digitalProductDelivery?: null|\Dodopayments\Products\ProductCreateParams\DigitalProductDelivery|DigitalProductDeliveryShape,
 *   entitlements?: list<AttachProductEntitlement|AttachProductEntitlementShape>|null,
 *   licenseKeyActivationMessage?: string|null,
 *   licenseKeyActivationsLimit?: int|null,
 *   licenseKeyDuration?: null|LicenseKeyDuration|LicenseKeyDurationShape,
 *   licenseKeyEnabled?: bool|null,
 *   metadata?: array<string,string>|null,
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
     *
     * @var PriceVariants $price
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
     * Optional credit entitlements to attach (max 3).
     *
     * @var list<AttachCreditEntitlement>|null $creditEntitlements
     */
    #[Optional(
        'credit_entitlements',
        list: AttachCreditEntitlement::class,
        nullable: true
    )]
    public ?array $creditEntitlements;

    /**
     * Optional description of the product.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Choose how you would like you digital product delivered.
     *
     * deprecated: use entitlements instead
     */
    #[Optional('digital_product_delivery', nullable: true)]
    public ?DigitalProductDelivery $digitalProductDelivery;

    /**
     * Optional entitlements to attach to this product (max 20).
     *
     * @var list<AttachProductEntitlement>|null $entitlements
     */
    #[Optional(list: AttachProductEntitlement::class, nullable: true)]
    public ?array $entitlements;

    /**
     * @deprecated
     *
     * Optional message displayed during license key activation
     *
     * deprecated: use entitlements instead. Ignored when a `license_key`
     * entitlement is attached via the `entitlements` field.
     */
    #[Optional('license_key_activation_message', nullable: true)]
    public ?string $licenseKeyActivationMessage;

    /**
     * @deprecated
     *
     * The number of times the license key can be activated.
     * Must be 0 or greater
     *
     * deprecated: use entitlements instead. Ignored when a `license_key`
     * entitlement is attached via the `entitlements` field.
     */
    #[Optional('license_key_activations_limit', nullable: true)]
    public ?int $licenseKeyActivationsLimit;

    /**
     * Duration configuration for the license key.
     * Set to null if you don't want the license key to expire.
     * For subscriptions, the lifetime of the license key is tied to the subscription period.
     *
     * deprecated: use entitlements instead. Ignored when a `license_key`
     * entitlement is attached via the `entitlements` field.
     */
    #[Optional('license_key_duration', nullable: true)]
    public ?LicenseKeyDuration $licenseKeyDuration;

    /**
     * @deprecated
     *
     * When true, generates and sends a license key to your customer.
     * Defaults to false
     *
     * deprecated: use entitlements instead. If a `license_key` entitlement is
     * also attached via the `entitlements` field, the `license_key_*` config
     * fields below are ignored — the attached entitlement's config is the
     * source of truth.
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
     * @param PriceShape $price
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     * @param list<string>|null $addons
     * @param list<AttachCreditEntitlement|AttachCreditEntitlementShape>|null $creditEntitlements
     * @param DigitalProductDelivery|DigitalProductDeliveryShape|null $digitalProductDelivery
     * @param list<AttachProductEntitlement|AttachProductEntitlementShape>|null $entitlements
     * @param LicenseKeyDuration|LicenseKeyDurationShape|null $licenseKeyDuration
     * @param array<string,string>|null $metadata
     */
    public static function with(
        string $name,
        OneTimePrice|array|RecurringPrice|UsageBasedPrice $price,
        TaxCategory|string $taxCategory,
        ?array $addons = null,
        ?string $brandID = null,
        ?array $creditEntitlements = null,
        ?string $description = null,
        DigitalProductDelivery|array|null $digitalProductDelivery = null,
        ?array $entitlements = null,
        ?string $licenseKeyActivationMessage = null,
        ?int $licenseKeyActivationsLimit = null,
        LicenseKeyDuration|array|null $licenseKeyDuration = null,
        ?bool $licenseKeyEnabled = null,
        ?array $metadata = null,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['price'] = $price;
        $self['taxCategory'] = $taxCategory;

        null !== $addons && $self['addons'] = $addons;
        null !== $brandID && $self['brandID'] = $brandID;
        null !== $creditEntitlements && $self['creditEntitlements'] = $creditEntitlements;
        null !== $description && $self['description'] = $description;
        null !== $digitalProductDelivery && $self['digitalProductDelivery'] = $digitalProductDelivery;
        null !== $entitlements && $self['entitlements'] = $entitlements;
        null !== $licenseKeyActivationMessage && $self['licenseKeyActivationMessage'] = $licenseKeyActivationMessage;
        null !== $licenseKeyActivationsLimit && $self['licenseKeyActivationsLimit'] = $licenseKeyActivationsLimit;
        null !== $licenseKeyDuration && $self['licenseKeyDuration'] = $licenseKeyDuration;
        null !== $licenseKeyEnabled && $self['licenseKeyEnabled'] = $licenseKeyEnabled;
        null !== $metadata && $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Name of the product.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Price configuration for the product.
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
     * Tax category applied to this product.
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
     * Addons available for subscription product.
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
     * Brand id for the product, if not provided will default to primary brand.
     */
    public function withBrandID(?string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    /**
     * Optional credit entitlements to attach (max 3).
     *
     * @param list<AttachCreditEntitlement|AttachCreditEntitlementShape>|null $creditEntitlements
     */
    public function withCreditEntitlements(?array $creditEntitlements): self
    {
        $self = clone $this;
        $self['creditEntitlements'] = $creditEntitlements;

        return $self;
    }

    /**
     * Optional description of the product.
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
     * deprecated: use entitlements instead
     *
     * @param DigitalProductDelivery|DigitalProductDeliveryShape|null $digitalProductDelivery
     */
    public function withDigitalProductDelivery(
        DigitalProductDelivery|array|null $digitalProductDelivery,
    ): self {
        $self = clone $this;
        $self['digitalProductDelivery'] = $digitalProductDelivery;

        return $self;
    }

    /**
     * Optional entitlements to attach to this product (max 20).
     *
     * @param list<AttachProductEntitlement|AttachProductEntitlementShape>|null $entitlements
     */
    public function withEntitlements(?array $entitlements): self
    {
        $self = clone $this;
        $self['entitlements'] = $entitlements;

        return $self;
    }

    /**
     * Optional message displayed during license key activation.
     *
     * deprecated: use entitlements instead. Ignored when a `license_key`
     * entitlement is attached via the `entitlements` field.
     */
    public function withLicenseKeyActivationMessage(
        ?string $licenseKeyActivationMessage
    ): self {
        $self = clone $this;
        $self['licenseKeyActivationMessage'] = $licenseKeyActivationMessage;

        return $self;
    }

    /**
     * The number of times the license key can be activated.
     * Must be 0 or greater.
     *
     * deprecated: use entitlements instead. Ignored when a `license_key`
     * entitlement is attached via the `entitlements` field.
     */
    public function withLicenseKeyActivationsLimit(
        ?int $licenseKeyActivationsLimit
    ): self {
        $self = clone $this;
        $self['licenseKeyActivationsLimit'] = $licenseKeyActivationsLimit;

        return $self;
    }

    /**
     * Duration configuration for the license key.
     * Set to null if you don't want the license key to expire.
     * For subscriptions, the lifetime of the license key is tied to the subscription period.
     *
     * deprecated: use entitlements instead. Ignored when a `license_key`
     * entitlement is attached via the `entitlements` field.
     *
     * @param LicenseKeyDuration|LicenseKeyDurationShape|null $licenseKeyDuration
     */
    public function withLicenseKeyDuration(
        LicenseKeyDuration|array|null $licenseKeyDuration
    ): self {
        $self = clone $this;
        $self['licenseKeyDuration'] = $licenseKeyDuration;

        return $self;
    }

    /**
     * When true, generates and sends a license key to your customer.
     * Defaults to false.
     *
     * deprecated: use entitlements instead. If a `license_key` entitlement is
     * also attached via the `entitlements` field, the `license_key_*` config
     * fields below are ignored — the attached entitlement's config is the
     * source of truth.
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
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }
}
