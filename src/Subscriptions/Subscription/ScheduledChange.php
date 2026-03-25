<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\Subscription;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\Subscription\ScheduledChange\Addon;

/**
 * Scheduled plan change details, if any.
 *
 * @phpstan-import-type AddonShape from \Dodopayments\Subscriptions\Subscription\ScheduledChange\Addon
 *
 * @phpstan-type ScheduledChangeShape = array{
 *   id: string,
 *   addons: list<Addon|AddonShape>,
 *   createdAt: \DateTimeInterface,
 *   effectiveAt: \DateTimeInterface,
 *   productID: string,
 *   quantity: int,
 *   productDescription?: string|null,
 *   productName?: string|null,
 * }
 */
final class ScheduledChange implements BaseModel
{
    /** @use SdkModel<ScheduledChangeShape> */
    use SdkModel;

    /**
     * The scheduled plan change ID.
     */
    #[Required]
    public string $id;

    /**
     * Addons included in the scheduled change.
     *
     * @var list<Addon> $addons
     */
    #[Required(list: Addon::class)]
    public array $addons;

    /**
     * When this scheduled change was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * When the change will be applied.
     */
    #[Required('effective_at')]
    public \DateTimeInterface $effectiveAt;

    /**
     * The product ID the subscription will change to.
     */
    #[Required('product_id')]
    public string $productID;

    /**
     * Quantity for the new plan.
     */
    #[Required]
    public int $quantity;

    /**
     * Description of the product being changed to.
     */
    #[Optional('product_description', nullable: true)]
    public ?string $productDescription;

    /**
     * Name of the product being changed to.
     */
    #[Optional('product_name', nullable: true)]
    public ?string $productName;

    /**
     * `new ScheduledChange()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ScheduledChange::with(
     *   id: ...,
     *   addons: ...,
     *   createdAt: ...,
     *   effectiveAt: ...,
     *   productID: ...,
     *   quantity: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ScheduledChange)
     *   ->withID(...)
     *   ->withAddons(...)
     *   ->withCreatedAt(...)
     *   ->withEffectiveAt(...)
     *   ->withProductID(...)
     *   ->withQuantity(...)
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
     * @param list<Addon|AddonShape> $addons
     */
    public static function with(
        string $id,
        array $addons,
        \DateTimeInterface $createdAt,
        \DateTimeInterface $effectiveAt,
        string $productID,
        int $quantity,
        ?string $productDescription = null,
        ?string $productName = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['addons'] = $addons;
        $self['createdAt'] = $createdAt;
        $self['effectiveAt'] = $effectiveAt;
        $self['productID'] = $productID;
        $self['quantity'] = $quantity;

        null !== $productDescription && $self['productDescription'] = $productDescription;
        null !== $productName && $self['productName'] = $productName;

        return $self;
    }

    /**
     * The scheduled plan change ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Addons included in the scheduled change.
     *
     * @param list<Addon|AddonShape> $addons
     */
    public function withAddons(array $addons): self
    {
        $self = clone $this;
        $self['addons'] = $addons;

        return $self;
    }

    /**
     * When this scheduled change was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * When the change will be applied.
     */
    public function withEffectiveAt(\DateTimeInterface $effectiveAt): self
    {
        $self = clone $this;
        $self['effectiveAt'] = $effectiveAt;

        return $self;
    }

    /**
     * The product ID the subscription will change to.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * Quantity for the new plan.
     */
    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * Description of the product being changed to.
     */
    public function withProductDescription(?string $productDescription): self
    {
        $self = clone $this;
        $self['productDescription'] = $productDescription;

        return $self;
    }

    /**
     * Name of the product being changed to.
     */
    public function withProductName(?string $productName): self
    {
        $self = clone $this;
        $self['productName'] = $productName;

        return $self;
    }
}
