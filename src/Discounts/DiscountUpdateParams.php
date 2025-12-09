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
        $obj = new self;

        null !== $amount && $obj['amount'] = $amount;
        null !== $code && $obj['code'] = $code;
        null !== $expiresAt && $obj['expiresAt'] = $expiresAt;
        null !== $name && $obj['name'] = $name;
        null !== $restrictedTo && $obj['restrictedTo'] = $restrictedTo;
        null !== $subscriptionCycles && $obj['subscriptionCycles'] = $subscriptionCycles;
        null !== $type && $obj['type'] = $type;
        null !== $usageLimit && $obj['usageLimit'] = $usageLimit;

        return $obj;
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
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }

    /**
     * If present, update the discount code (uppercase).
     */
    public function withCode(?string $code): self
    {
        $obj = clone $this;
        $obj['code'] = $code;

        return $obj;
    }

    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $obj = clone $this;
        $obj['expiresAt'] = $expiresAt;

        return $obj;
    }

    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * If present, replaces all restricted product IDs with this new set.
     * To remove all restrictions, send empty array.
     *
     * @param list<string>|null $restrictedTo
     */
    public function withRestrictedTo(?array $restrictedTo): self
    {
        $obj = clone $this;
        $obj['restrictedTo'] = $restrictedTo;

        return $obj;
    }

    /**
     * Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     */
    public function withSubscriptionCycles(?int $subscriptionCycles): self
    {
        $obj = clone $this;
        $obj['subscriptionCycles'] = $subscriptionCycles;

        return $obj;
    }

    /**
     * If present, update the discount type.
     *
     * @param DiscountType|value-of<DiscountType>|null $type
     */
    public function withType(DiscountType|string|null $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }

    public function withUsageLimit(?int $usageLimit): self
    {
        $obj = clone $this;
        $obj['usageLimit'] = $usageLimit;

        return $obj;
    }
}
