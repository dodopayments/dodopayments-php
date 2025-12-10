<?php

declare(strict_types=1);

namespace Dodopayments\Discounts;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * PATCH /discounts/{discount_id}.
 *
 * @see Dodopayments\Services\DiscountsService::update()
 *
 * @phpstan-type DiscountUpdateParamsShape = array{
 *   amount?: int|null,
 *   code?: string|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   name?: string|null,
 *   restrictedTo?: list<string>|null,
 *   subscriptionCycles?: int|null,
 *   type?: null|DiscountType|value-of<DiscountType>,
 *   usageLimit?: int|null,
 * }
 */
final class DiscountUpdateParams implements BaseModel
{
    /** @use SdkModel<DiscountUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * If present, update the discount amount:
     * - If `discount_type` is `percentage`, this represents **basis points** (e.g., `540` = `5.4%`).
     * - Otherwise, this represents **USD cents** (e.g., `100` = `$1.00`).
     *
     * Must be at least 1 if provided.
     */
    #[Optional(nullable: true)]
    public ?int $amount;

    /**
     * If present, update the discount code (uppercase).
     */
    #[Optional(nullable: true)]
    public ?string $code;

    #[Optional('expires_at', nullable: true)]
    public ?\DateTimeInterface $expiresAt;

    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * If present, replaces all restricted product IDs with this new set.
     * To remove all restrictions, send empty array.
     *
     * @var list<string>|null $restrictedTo
     */
    #[Optional('restricted_to', list: 'string', nullable: true)]
    public ?array $restrictedTo;

    /**
     * Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     */
    #[Optional('subscription_cycles', nullable: true)]
    public ?int $subscriptionCycles;

    /**
     * If present, update the discount type.
     *
     * @var value-of<DiscountType>|null $type
     */
    #[Optional(enum: DiscountType::class, nullable: true)]
    public ?string $type;

    #[Optional('usage_limit', nullable: true)]
    public ?int $usageLimit;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $restrictedTo
     * @param DiscountType|value-of<DiscountType>|null $type
     */
    public static function with(
        ?int $amount = null,
        ?string $code = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $name = null,
        ?array $restrictedTo = null,
        ?int $subscriptionCycles = null,
        DiscountType|string|null $type = null,
        ?int $usageLimit = null,
    ): self {
        $self = new self;

        null !== $amount && $self['amount'] = $amount;
        null !== $code && $self['code'] = $code;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $name && $self['name'] = $name;
        null !== $restrictedTo && $self['restrictedTo'] = $restrictedTo;
        null !== $subscriptionCycles && $self['subscriptionCycles'] = $subscriptionCycles;
        null !== $type && $self['type'] = $type;
        null !== $usageLimit && $self['usageLimit'] = $usageLimit;

        return $self;
    }

    /**
     * If present, update the discount amount:
     * - If `discount_type` is `percentage`, this represents **basis points** (e.g., `540` = `5.4%`).
     * - Otherwise, this represents **USD cents** (e.g., `100` = `$1.00`).
     *
     * Must be at least 1 if provided.
     */
    public function withAmount(?int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * If present, update the discount code (uppercase).
     */
    public function withCode(?string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * If present, replaces all restricted product IDs with this new set.
     * To remove all restrictions, send empty array.
     *
     * @param list<string>|null $restrictedTo
     */
    public function withRestrictedTo(?array $restrictedTo): self
    {
        $self = clone $this;
        $self['restrictedTo'] = $restrictedTo;

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
     * If present, update the discount type.
     *
     * @param DiscountType|value-of<DiscountType>|null $type
     */
    public function withType(DiscountType|string|null $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withUsageLimit(?int $usageLimit): self
    {
        $self = clone $this;
        $self['usageLimit'] = $usageLimit;

        return $self;
    }
}
