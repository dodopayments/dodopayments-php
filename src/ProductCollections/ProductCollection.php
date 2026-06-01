<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\ProductCollections\Groups\ProductCollectionGroupResponse;
use Dodopayments\ProductCollections\ProductCollection\EffectiveAtOnDowngrade;
use Dodopayments\ProductCollections\ProductCollection\EffectiveAtOnUpgrade;
use Dodopayments\ProductCollections\ProductCollection\OnPaymentFailure;
use Dodopayments\ProductCollections\ProductCollection\ProrationBillingModeOnDowngrade;
use Dodopayments\ProductCollections\ProductCollection\ProrationBillingModeOnUpgrade;

/**
 * @phpstan-import-type ProductCollectionGroupResponseShape from \Dodopayments\ProductCollections\Groups\ProductCollectionGroupResponse
 *
 * @phpstan-type ProductCollectionShape = array{
 *   id: string,
 *   brandID: string,
 *   createdAt: \DateTimeInterface,
 *   groups: list<ProductCollectionGroupResponse|ProductCollectionGroupResponseShape>,
 *   name: string,
 *   updatedAt: \DateTimeInterface,
 *   description?: string|null,
 *   effectiveAtOnDowngrade?: null|EffectiveAtOnDowngrade|value-of<EffectiveAtOnDowngrade>,
 *   effectiveAtOnUpgrade?: null|EffectiveAtOnUpgrade|value-of<EffectiveAtOnUpgrade>,
 *   image?: string|null,
 *   onPaymentFailure?: null|OnPaymentFailure|value-of<OnPaymentFailure>,
 *   prorationBillingModeOnDowngrade?: null|ProrationBillingModeOnDowngrade|value-of<ProrationBillingModeOnDowngrade>,
 *   prorationBillingModeOnUpgrade?: null|ProrationBillingModeOnUpgrade|value-of<ProrationBillingModeOnUpgrade>,
 * }
 */
final class ProductCollection implements BaseModel
{
    /** @use SdkModel<ProductCollectionShape> */
    use SdkModel;

    /**
     * Unique identifier for the product collection.
     */
    #[Required]
    public string $id;

    /**
     * Brand ID for the collection.
     */
    #[Required('brand_id')]
    public string $brandID;

    /**
     * Timestamp when the collection was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Groups in this collection.
     *
     * @var list<ProductCollectionGroupResponse> $groups
     */
    #[Required(list: ProductCollectionGroupResponse::class)]
    public array $groups;

    /**
     * Name of the collection.
     */
    #[Required]
    public string $name;

    /**
     * Timestamp when the collection was last updated.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Description of the collection.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Default effective_at setting for subscription plan downgrades (null = inherit from business).
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
     * Default effective_at setting for subscription plan upgrades (null = inherit from business).
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
     * URL of the collection image.
     */
    #[Optional(nullable: true)]
    public ?string $image;

    /**
     * Default behavior for subscription plan changes on payment failure (null = inherit from business).
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
     * Default proration billing mode for subscription plan downgrades (null = inherit from business).
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
     * Default proration billing mode for subscription plan upgrades (null = inherit from business).
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
     * `new ProductCollection()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductCollection::with(
     *   id: ..., brandID: ..., createdAt: ..., groups: ..., name: ..., updatedAt: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductCollection)
     *   ->withID(...)
     *   ->withBrandID(...)
     *   ->withCreatedAt(...)
     *   ->withGroups(...)
     *   ->withName(...)
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
     * @param list<ProductCollectionGroupResponse|ProductCollectionGroupResponseShape> $groups
     * @param EffectiveAtOnDowngrade|value-of<EffectiveAtOnDowngrade>|null $effectiveAtOnDowngrade
     * @param EffectiveAtOnUpgrade|value-of<EffectiveAtOnUpgrade>|null $effectiveAtOnUpgrade
     * @param OnPaymentFailure|value-of<OnPaymentFailure>|null $onPaymentFailure
     * @param ProrationBillingModeOnDowngrade|value-of<ProrationBillingModeOnDowngrade>|null $prorationBillingModeOnDowngrade
     * @param ProrationBillingModeOnUpgrade|value-of<ProrationBillingModeOnUpgrade>|null $prorationBillingModeOnUpgrade
     */
    public static function with(
        string $id,
        string $brandID,
        \DateTimeInterface $createdAt,
        array $groups,
        string $name,
        \DateTimeInterface $updatedAt,
        ?string $description = null,
        EffectiveAtOnDowngrade|string|null $effectiveAtOnDowngrade = null,
        EffectiveAtOnUpgrade|string|null $effectiveAtOnUpgrade = null,
        ?string $image = null,
        OnPaymentFailure|string|null $onPaymentFailure = null,
        ProrationBillingModeOnDowngrade|string|null $prorationBillingModeOnDowngrade = null,
        ProrationBillingModeOnUpgrade|string|null $prorationBillingModeOnUpgrade = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['brandID'] = $brandID;
        $self['createdAt'] = $createdAt;
        $self['groups'] = $groups;
        $self['name'] = $name;
        $self['updatedAt'] = $updatedAt;

        null !== $description && $self['description'] = $description;
        null !== $effectiveAtOnDowngrade && $self['effectiveAtOnDowngrade'] = $effectiveAtOnDowngrade;
        null !== $effectiveAtOnUpgrade && $self['effectiveAtOnUpgrade'] = $effectiveAtOnUpgrade;
        null !== $image && $self['image'] = $image;
        null !== $onPaymentFailure && $self['onPaymentFailure'] = $onPaymentFailure;
        null !== $prorationBillingModeOnDowngrade && $self['prorationBillingModeOnDowngrade'] = $prorationBillingModeOnDowngrade;
        null !== $prorationBillingModeOnUpgrade && $self['prorationBillingModeOnUpgrade'] = $prorationBillingModeOnUpgrade;

        return $self;
    }

    /**
     * Unique identifier for the product collection.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Brand ID for the collection.
     */
    public function withBrandID(string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    /**
     * Timestamp when the collection was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Groups in this collection.
     *
     * @param list<ProductCollectionGroupResponse|ProductCollectionGroupResponseShape> $groups
     */
    public function withGroups(array $groups): self
    {
        $self = clone $this;
        $self['groups'] = $groups;

        return $self;
    }

    /**
     * Name of the collection.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Timestamp when the collection was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Description of the collection.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Default effective_at setting for subscription plan downgrades (null = inherit from business).
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
     * Default effective_at setting for subscription plan upgrades (null = inherit from business).
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
     * URL of the collection image.
     */
    public function withImage(?string $image): self
    {
        $self = clone $this;
        $self['image'] = $image;

        return $self;
    }

    /**
     * Default behavior for subscription plan changes on payment failure (null = inherit from business).
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
     * Default proration billing mode for subscription plan downgrades (null = inherit from business).
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
     * Default proration billing mode for subscription plan upgrades (null = inherit from business).
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
