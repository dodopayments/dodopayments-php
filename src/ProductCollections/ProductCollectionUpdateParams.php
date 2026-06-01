<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\ProductCollections\ProductCollectionUpdateParams\EffectiveAtOnDowngrade;
use Dodopayments\ProductCollections\ProductCollectionUpdateParams\EffectiveAtOnUpgrade;
use Dodopayments\ProductCollections\ProductCollectionUpdateParams\OnPaymentFailure;
use Dodopayments\ProductCollections\ProductCollectionUpdateParams\ProrationBillingModeOnDowngrade;
use Dodopayments\ProductCollections\ProductCollectionUpdateParams\ProrationBillingModeOnUpgrade;

/**
 * @see Dodopayments\Services\ProductCollectionsService::update()
 *
 * @phpstan-type ProductCollectionUpdateParamsShape = array{
 *   brandID?: string|null,
 *   description?: string|null,
 *   effectiveAtOnDowngrade?: null|EffectiveAtOnDowngrade|value-of<EffectiveAtOnDowngrade>,
 *   effectiveAtOnUpgrade?: null|EffectiveAtOnUpgrade|value-of<EffectiveAtOnUpgrade>,
 *   groupOrder?: list<string>|null,
 *   imageID?: string|null,
 *   name?: string|null,
 *   onPaymentFailure?: null|OnPaymentFailure|value-of<OnPaymentFailure>,
 *   prorationBillingModeOnDowngrade?: null|ProrationBillingModeOnDowngrade|value-of<ProrationBillingModeOnDowngrade>,
 *   prorationBillingModeOnUpgrade?: null|ProrationBillingModeOnUpgrade|value-of<ProrationBillingModeOnUpgrade>,
 * }
 */
final class ProductCollectionUpdateParams implements BaseModel
{
    /** @use SdkModel<ProductCollectionUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Optional brand_id update.
     */
    #[Optional('brand_id', nullable: true)]
    public ?string $brandID;

    /**
     * Optional description update - pass null to remove, omit to keep unchanged.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Effective_at setting for downgrades: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change.
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
     * Effective_at setting for upgrades: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change.
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
     * Optional new order for groups (array of group UUIDs in desired order).
     *
     * @var list<string>|null $groupOrder
     */
    #[Optional('group_order', list: 'string', nullable: true)]
    public ?array $groupOrder;

    /**
     * Optional image update - pass null to remove, omit to keep unchanged.
     */
    #[Optional('image_id', nullable: true)]
    public ?string $imageID;

    /**
     * Optional new name for the collection.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * On payment failure behavior: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change.
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
     * Proration billing mode for downgrades: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change.
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
     * Proration billing mode for upgrades: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change.
     *
     * @var value-of<ProrationBillingModeOnUpgrade>|null $prorationBillingModeOnUpgrade
     */
    #[Optional(
        'proration_billing_mode_on_upgrade',
        enum: ProrationBillingModeOnUpgrade::class,
        nullable: true,
    )]
    public ?string $prorationBillingModeOnUpgrade;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param EffectiveAtOnDowngrade|value-of<EffectiveAtOnDowngrade>|null $effectiveAtOnDowngrade
     * @param EffectiveAtOnUpgrade|value-of<EffectiveAtOnUpgrade>|null $effectiveAtOnUpgrade
     * @param list<string>|null $groupOrder
     * @param OnPaymentFailure|value-of<OnPaymentFailure>|null $onPaymentFailure
     * @param ProrationBillingModeOnDowngrade|value-of<ProrationBillingModeOnDowngrade>|null $prorationBillingModeOnDowngrade
     * @param ProrationBillingModeOnUpgrade|value-of<ProrationBillingModeOnUpgrade>|null $prorationBillingModeOnUpgrade
     */
    public static function with(
        ?string $brandID = null,
        ?string $description = null,
        EffectiveAtOnDowngrade|string|null $effectiveAtOnDowngrade = null,
        EffectiveAtOnUpgrade|string|null $effectiveAtOnUpgrade = null,
        ?array $groupOrder = null,
        ?string $imageID = null,
        ?string $name = null,
        OnPaymentFailure|string|null $onPaymentFailure = null,
        ProrationBillingModeOnDowngrade|string|null $prorationBillingModeOnDowngrade = null,
        ProrationBillingModeOnUpgrade|string|null $prorationBillingModeOnUpgrade = null,
    ): self {
        $self = new self;

        null !== $brandID && $self['brandID'] = $brandID;
        null !== $description && $self['description'] = $description;
        null !== $effectiveAtOnDowngrade && $self['effectiveAtOnDowngrade'] = $effectiveAtOnDowngrade;
        null !== $effectiveAtOnUpgrade && $self['effectiveAtOnUpgrade'] = $effectiveAtOnUpgrade;
        null !== $groupOrder && $self['groupOrder'] = $groupOrder;
        null !== $imageID && $self['imageID'] = $imageID;
        null !== $name && $self['name'] = $name;
        null !== $onPaymentFailure && $self['onPaymentFailure'] = $onPaymentFailure;
        null !== $prorationBillingModeOnDowngrade && $self['prorationBillingModeOnDowngrade'] = $prorationBillingModeOnDowngrade;
        null !== $prorationBillingModeOnUpgrade && $self['prorationBillingModeOnUpgrade'] = $prorationBillingModeOnUpgrade;

        return $self;
    }

    /**
     * Optional brand_id update.
     */
    public function withBrandID(?string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    /**
     * Optional description update - pass null to remove, omit to keep unchanged.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Effective_at setting for downgrades: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change.
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
     * Effective_at setting for upgrades: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change.
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
     * Optional new order for groups (array of group UUIDs in desired order).
     *
     * @param list<string>|null $groupOrder
     */
    public function withGroupOrder(?array $groupOrder): self
    {
        $self = clone $this;
        $self['groupOrder'] = $groupOrder;

        return $self;
    }

    /**
     * Optional image update - pass null to remove, omit to keep unchanged.
     */
    public function withImageID(?string $imageID): self
    {
        $self = clone $this;
        $self['imageID'] = $imageID;

        return $self;
    }

    /**
     * Optional new name for the collection.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * On payment failure behavior: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change.
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
     * Proration billing mode for downgrades: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change.
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
     * Proration billing mode for upgrades: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change.
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
