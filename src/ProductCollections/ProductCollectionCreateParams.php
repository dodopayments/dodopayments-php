<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\ProductCollections\Groups\ProductCollectionGroupDetails;
use Dodopayments\ProductCollections\ProductCollectionCreateParams\EffectiveAtOnDowngrade;
use Dodopayments\ProductCollections\ProductCollectionCreateParams\EffectiveAtOnUpgrade;
use Dodopayments\ProductCollections\ProductCollectionCreateParams\OnPaymentFailure;
use Dodopayments\ProductCollections\ProductCollectionCreateParams\ProrationBillingModeOnDowngrade;
use Dodopayments\ProductCollections\ProductCollectionCreateParams\ProrationBillingModeOnUpgrade;

/**
 * @see Dodopayments\Services\ProductCollectionsService::create()
 *
 * @phpstan-import-type ProductCollectionGroupDetailsShape from \Dodopayments\ProductCollections\Groups\ProductCollectionGroupDetails
 *
 * @phpstan-type ProductCollectionCreateParamsShape = array{
 *   groups: list<ProductCollectionGroupDetails|ProductCollectionGroupDetailsShape>,
 *   name: string,
 *   brandID?: string|null,
 *   description?: string|null,
 *   effectiveAtOnDowngrade?: null|EffectiveAtOnDowngrade|value-of<EffectiveAtOnDowngrade>,
 *   effectiveAtOnUpgrade?: null|EffectiveAtOnUpgrade|value-of<EffectiveAtOnUpgrade>,
 *   onPaymentFailure?: null|OnPaymentFailure|value-of<OnPaymentFailure>,
 *   prorationBillingModeOnDowngrade?: null|ProrationBillingModeOnDowngrade|value-of<ProrationBillingModeOnDowngrade>,
 *   prorationBillingModeOnUpgrade?: null|ProrationBillingModeOnUpgrade|value-of<ProrationBillingModeOnUpgrade>,
 * }
 */
final class ProductCollectionCreateParams implements BaseModel
{
    /** @use SdkModel<ProductCollectionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Groups of products in this collection.
     *
     * @var list<ProductCollectionGroupDetails> $groups
     */
    #[Required(list: ProductCollectionGroupDetails::class)]
    public array $groups;

    /**
     * Name of the product collection.
     */
    #[Required]
    public string $name;

    /**
     * Brand id for the collection, if not provided will default to primary brand.
     */
    #[Optional('brand_id', nullable: true)]
    public ?string $brandID;

    /**
     * Optional description of the product collection.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Default effective_at setting for subscription plan downgrades (NULL = inherit from business).
     *
     * @var value-of<EffectiveAtOnDowngrade>|null $effectiveAtOnDowngrade
     */
    #[Optional(
        'effective_at_on_downgrade',
        enum: EffectiveAtOnDowngrade::class,
        nullable: true,
    )]
    public ?string $effectiveAtOnDowngrade;

    /**
     * Default effective_at setting for subscription plan upgrades (NULL = inherit from business).
     *
     * @var value-of<EffectiveAtOnUpgrade>|null $effectiveAtOnUpgrade
     */
    #[Optional(
        'effective_at_on_upgrade',
        enum: EffectiveAtOnUpgrade::class,
        nullable: true
    )]
    public ?string $effectiveAtOnUpgrade;

    /**
     * Default behavior for subscription plan changes on payment failure (NULL = inherit from business).
     *
     * @var value-of<OnPaymentFailure>|null $onPaymentFailure
     */
    #[Optional(
        'on_payment_failure',
        enum: OnPaymentFailure::class,
        nullable: true
    )]
    public ?string $onPaymentFailure;

    /**
     * Default proration billing mode for subscription plan downgrades (NULL = inherit from business).
     *
     * @var value-of<ProrationBillingModeOnDowngrade>|null $prorationBillingModeOnDowngrade
     */
    #[Optional(
        'proration_billing_mode_on_downgrade',
        enum: ProrationBillingModeOnDowngrade::class,
        nullable: true,
    )]
    public ?string $prorationBillingModeOnDowngrade;

    /**
     * Default proration billing mode for subscription plan upgrades (NULL = inherit from business).
     *
     * @var value-of<ProrationBillingModeOnUpgrade>|null $prorationBillingModeOnUpgrade
     */
    #[Optional(
        'proration_billing_mode_on_upgrade',
        enum: ProrationBillingModeOnUpgrade::class,
        nullable: true,
    )]
    public ?string $prorationBillingModeOnUpgrade;

    /**
     * `new ProductCollectionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductCollectionCreateParams::with(groups: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductCollectionCreateParams)->withGroups(...)->withName(...)
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
     * @param list<ProductCollectionGroupDetails|ProductCollectionGroupDetailsShape> $groups
     * @param EffectiveAtOnDowngrade|value-of<EffectiveAtOnDowngrade>|null $effectiveAtOnDowngrade
     * @param EffectiveAtOnUpgrade|value-of<EffectiveAtOnUpgrade>|null $effectiveAtOnUpgrade
     * @param OnPaymentFailure|value-of<OnPaymentFailure>|null $onPaymentFailure
     * @param ProrationBillingModeOnDowngrade|value-of<ProrationBillingModeOnDowngrade>|null $prorationBillingModeOnDowngrade
     * @param ProrationBillingModeOnUpgrade|value-of<ProrationBillingModeOnUpgrade>|null $prorationBillingModeOnUpgrade
     */
    public static function with(
        array $groups,
        string $name,
        ?string $brandID = null,
        ?string $description = null,
        EffectiveAtOnDowngrade|string|null $effectiveAtOnDowngrade = null,
        EffectiveAtOnUpgrade|string|null $effectiveAtOnUpgrade = null,
        OnPaymentFailure|string|null $onPaymentFailure = null,
        ProrationBillingModeOnDowngrade|string|null $prorationBillingModeOnDowngrade = null,
        ProrationBillingModeOnUpgrade|string|null $prorationBillingModeOnUpgrade = null,
    ): self {
        $self = new self;

        $self['groups'] = $groups;
        $self['name'] = $name;

        null !== $brandID && $self['brandID'] = $brandID;
        null !== $description && $self['description'] = $description;
        null !== $effectiveAtOnDowngrade && $self['effectiveAtOnDowngrade'] = $effectiveAtOnDowngrade;
        null !== $effectiveAtOnUpgrade && $self['effectiveAtOnUpgrade'] = $effectiveAtOnUpgrade;
        null !== $onPaymentFailure && $self['onPaymentFailure'] = $onPaymentFailure;
        null !== $prorationBillingModeOnDowngrade && $self['prorationBillingModeOnDowngrade'] = $prorationBillingModeOnDowngrade;
        null !== $prorationBillingModeOnUpgrade && $self['prorationBillingModeOnUpgrade'] = $prorationBillingModeOnUpgrade;

        return $self;
    }

    /**
     * Groups of products in this collection.
     *
     * @param list<ProductCollectionGroupDetails|ProductCollectionGroupDetailsShape> $groups
     */
    public function withGroups(array $groups): self
    {
        $self = clone $this;
        $self['groups'] = $groups;

        return $self;
    }

    /**
     * Name of the product collection.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Brand id for the collection, if not provided will default to primary brand.
     */
    public function withBrandID(?string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    /**
     * Optional description of the product collection.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Default effective_at setting for subscription plan downgrades (NULL = inherit from business).
     *
     * @param EffectiveAtOnDowngrade|value-of<EffectiveAtOnDowngrade>|null $effectiveAtOnDowngrade
     */
    public function withEffectiveAtOnDowngrade(
        EffectiveAtOnDowngrade|string|null $effectiveAtOnDowngrade
    ): self {
        $self = clone $this;
        $self['effectiveAtOnDowngrade'] = $effectiveAtOnDowngrade;

        return $self;
    }

    /**
     * Default effective_at setting for subscription plan upgrades (NULL = inherit from business).
     *
     * @param EffectiveAtOnUpgrade|value-of<EffectiveAtOnUpgrade>|null $effectiveAtOnUpgrade
     */
    public function withEffectiveAtOnUpgrade(
        EffectiveAtOnUpgrade|string|null $effectiveAtOnUpgrade
    ): self {
        $self = clone $this;
        $self['effectiveAtOnUpgrade'] = $effectiveAtOnUpgrade;

        return $self;
    }

    /**
     * Default behavior for subscription plan changes on payment failure (NULL = inherit from business).
     *
     * @param OnPaymentFailure|value-of<OnPaymentFailure>|null $onPaymentFailure
     */
    public function withOnPaymentFailure(
        OnPaymentFailure|string|null $onPaymentFailure
    ): self {
        $self = clone $this;
        $self['onPaymentFailure'] = $onPaymentFailure;

        return $self;
    }

    /**
     * Default proration billing mode for subscription plan downgrades (NULL = inherit from business).
     *
     * @param ProrationBillingModeOnDowngrade|value-of<ProrationBillingModeOnDowngrade>|null $prorationBillingModeOnDowngrade
     */
    public function withProrationBillingModeOnDowngrade(
        ProrationBillingModeOnDowngrade|string|null $prorationBillingModeOnDowngrade
    ): self {
        $self = clone $this;
        $self['prorationBillingModeOnDowngrade'] = $prorationBillingModeOnDowngrade;

        return $self;
    }

    /**
     * Default proration billing mode for subscription plan upgrades (NULL = inherit from business).
     *
     * @param ProrationBillingModeOnUpgrade|value-of<ProrationBillingModeOnUpgrade>|null $prorationBillingModeOnUpgrade
     */
    public function withProrationBillingModeOnUpgrade(
        ProrationBillingModeOnUpgrade|string|null $prorationBillingModeOnUpgrade
    ): self {
        $self = clone $this;
        $self['prorationBillingModeOnUpgrade'] = $prorationBillingModeOnUpgrade;

        return $self;
    }
}
