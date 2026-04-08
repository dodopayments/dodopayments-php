<?php

declare(strict_types=1);

namespace Dodopayments\Discounts;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type DiscountShape = array{
 *   amount: int,
 *   businessID: string,
 *   code: string,
 *   createdAt: \DateTimeInterface,
 *   discountID: string,
 *   metadata: array<string,string>,
 *   preserveOnPlanChange: bool,
 *   restrictedTo: list<string>,
 *   timesUsed: int,
 *   type: DiscountType|value-of<DiscountType>,
 *   expiresAt?: \DateTimeInterface|null,
 *   name?: string|null,
 *   subscriptionCycles?: int|null,
 *   usageLimit?: int|null,
 * }
 */
final class Discount implements BaseModel
{
    /** @use SdkModel<DiscountShape> */
    use SdkModel;

    /**
     * The discount amount.
     *
     * - If `discount_type` is `percentage`, this is in **basis points**
     *   (e.g., 540 => 5.4%).
     * - Otherwise, this is **USD cents** (e.g., 100 => `$1.00`).
     */
    #[Required]
    public int $amount;

    /**
     * The business this discount belongs to.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * The discount code (up to 16 chars).
     */
    #[Required]
    public string $code;

    /**
     * Timestamp when the discount is created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The unique discount ID.
     */
    #[Required('discount_id')]
    public string $discountID;

    /** @var array<string,string> $metadata */
    #[Required(map: 'string')]
    public array $metadata;

    /**
     * Whether this discount should be preserved when a subscription changes plans.
     * Default: false (discount is removed on plan change).
     */
    #[Required('preserve_on_plan_change')]
    public bool $preserveOnPlanChange;

    /**
     * List of product IDs to which this discount is restricted.
     *
     * @var list<string> $restrictedTo
     */
    #[Required('restricted_to', list: 'string')]
    public array $restrictedTo;

    /**
     * How many times this discount has been used.
     */
    #[Required('times_used')]
    public int $timesUsed;

    /**
     * The type of discount, e.g. `percentage`, `flat`, or `flat_per_unit`.
     *
     * @var value-of<DiscountType> $type
     */
    #[Required(enum: DiscountType::class)]
    public string $type;

    /**
     * Optional date/time after which discount is expired.
     */
    #[Optional('expires_at', nullable: true)]
    public ?\DateTimeInterface $expiresAt;

    /**
     * Name for the Discount.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     */
    #[Optional('subscription_cycles', nullable: true)]
    public ?int $subscriptionCycles;

    /**
     * Usage limit for this discount, if any.
     */
    #[Optional('usage_limit', nullable: true)]
    public ?int $usageLimit;

    /**
     * `new Discount()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Discount::with(
     *   amount: ...,
     *   businessID: ...,
     *   code: ...,
     *   createdAt: ...,
     *   discountID: ...,
     *   metadata: ...,
     *   preserveOnPlanChange: ...,
     *   restrictedTo: ...,
     *   timesUsed: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Discount)
     *   ->withAmount(...)
     *   ->withBusinessID(...)
     *   ->withCode(...)
     *   ->withCreatedAt(...)
     *   ->withDiscountID(...)
     *   ->withMetadata(...)
     *   ->withPreserveOnPlanChange(...)
     *   ->withRestrictedTo(...)
     *   ->withTimesUsed(...)
     *   ->withType(...)
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
     * @param array<string,string> $metadata
     * @param list<string> $restrictedTo
     * @param DiscountType|value-of<DiscountType> $type
     */
    public static function with(
        int $amount,
        string $businessID,
        string $code,
        \DateTimeInterface $createdAt,
        string $discountID,
        array $metadata,
        bool $preserveOnPlanChange,
        array $restrictedTo,
        int $timesUsed,
        DiscountType|string $type,
        ?\DateTimeInterface $expiresAt = null,
        ?string $name = null,
        ?int $subscriptionCycles = null,
        ?int $usageLimit = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['businessID'] = $businessID;
        $self['code'] = $code;
        $self['createdAt'] = $createdAt;
        $self['discountID'] = $discountID;
        $self['metadata'] = $metadata;
        $self['preserveOnPlanChange'] = $preserveOnPlanChange;
        $self['restrictedTo'] = $restrictedTo;
        $self['timesUsed'] = $timesUsed;
        $self['type'] = $type;

        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $name && $self['name'] = $name;
        null !== $subscriptionCycles && $self['subscriptionCycles'] = $subscriptionCycles;
        null !== $usageLimit && $self['usageLimit'] = $usageLimit;

        return $self;
    }

    /**
     * The discount amount.
     *
     * - If `discount_type` is `percentage`, this is in **basis points**
     *   (e.g., 540 => 5.4%).
     * - Otherwise, this is **USD cents** (e.g., 100 => `$1.00`).
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The business this discount belongs to.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * The discount code (up to 16 chars).
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Timestamp when the discount is created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The unique discount ID.
     */
    public function withDiscountID(string $discountID): self
    {
        $self = clone $this;
        $self['discountID'] = $discountID;

        return $self;
    }

    /**
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Whether this discount should be preserved when a subscription changes plans.
     * Default: false (discount is removed on plan change).
     */
    public function withPreserveOnPlanChange(bool $preserveOnPlanChange): self
    {
        $self = clone $this;
        $self['preserveOnPlanChange'] = $preserveOnPlanChange;

        return $self;
    }

    /**
     * List of product IDs to which this discount is restricted.
     *
     * @param list<string> $restrictedTo
     */
    public function withRestrictedTo(array $restrictedTo): self
    {
        $self = clone $this;
        $self['restrictedTo'] = $restrictedTo;

        return $self;
    }

    /**
     * How many times this discount has been used.
     */
    public function withTimesUsed(int $timesUsed): self
    {
        $self = clone $this;
        $self['timesUsed'] = $timesUsed;

        return $self;
    }

    /**
     * The type of discount, e.g. `percentage`, `flat`, or `flat_per_unit`.
     *
     * @param DiscountType|value-of<DiscountType> $type
     */
    public function withType(DiscountType|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Optional date/time after which discount is expired.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Name for the Discount.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     */
    public function withSubscriptionCycles(?int $subscriptionCycles): self
    {
        $self = clone $this;
        $self['subscriptionCycles'] = $subscriptionCycles;

        return $self;
    }

    /**
     * Usage limit for this discount, if any.
     */
    public function withUsageLimit(?int $usageLimit): self
    {
        $self = clone $this;
        $self['usageLimit'] = $usageLimit;

        return $self;
    }
}
