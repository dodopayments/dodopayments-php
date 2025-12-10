<?php

declare(strict_types=1);

namespace Dodopayments\Discounts;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * POST /discounts
 * If `code` is omitted or empty, a random 16-char uppercase code is generated.
 *
 * @see Dodopayments\Services\DiscountsService::create()
 *
 * @phpstan-type DiscountCreateParamsShape = array{
 *   amount: int,
 *   type: DiscountType|value-of<DiscountType>,
 *   code?: string|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   name?: string|null,
 *   restrictedTo?: list<string>|null,
 *   subscriptionCycles?: int|null,
 *   usageLimit?: int|null,
 * }
 */
final class DiscountCreateParams implements BaseModel
{
    /** @use SdkModel<DiscountCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The discount amount.
     *
     * - If `discount_type` is **not** `percentage`, `amount` is in **USD cents**. For example, `100` means `$1.00`.
     *   Only USD is allowed.
     * - If `discount_type` **is** `percentage`, `amount` is in **basis points**. For example, `540` means `5.4%`.
     *
     * Must be at least 1.
     */
    #[Required]
    public int $amount;

    /**
     * The discount type (e.g. `percentage`, `flat`, or `flat_per_unit`).
     *
     * @var value-of<DiscountType> $type
     */
    #[Required(enum: DiscountType::class)]
    public string $type;

    /**
     * Optionally supply a code (will be uppercased).
     * - Must be at least 3 characters if provided.
     * - If omitted, a random 16-character code is generated.
     */
    #[Optional(nullable: true)]
    public ?string $code;

    /**
     * When the discount expires, if ever.
     */
    #[Optional('expires_at', nullable: true)]
    public ?\DateTimeInterface $expiresAt;

    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * List of product IDs to restrict usage (if any).
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
     * How many times this discount can be used (if any).
     * Must be >= 1 if provided.
     */
    #[Optional('usage_limit', nullable: true)]
    public ?int $usageLimit;

    /**
     * `new DiscountCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DiscountCreateParams::with(amount: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DiscountCreateParams)->withAmount(...)->withType(...)
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
     * @param DiscountType|value-of<DiscountType> $type
     * @param list<string>|null $restrictedTo
     */
    public static function with(
        int $amount,
        DiscountType|string $type,
        ?string $code = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $name = null,
        ?array $restrictedTo = null,
        ?int $subscriptionCycles = null,
        ?int $usageLimit = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['type'] = $type;

        null !== $code && $self['code'] = $code;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $name && $self['name'] = $name;
        null !== $restrictedTo && $self['restrictedTo'] = $restrictedTo;
        null !== $subscriptionCycles && $self['subscriptionCycles'] = $subscriptionCycles;
        null !== $usageLimit && $self['usageLimit'] = $usageLimit;

        return $self;
    }

    /**
     * The discount amount.
     *
     * - If `discount_type` is **not** `percentage`, `amount` is in **USD cents**. For example, `100` means `$1.00`.
     *   Only USD is allowed.
     * - If `discount_type` **is** `percentage`, `amount` is in **basis points**. For example, `540` means `5.4%`.
     *
     * Must be at least 1.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The discount type (e.g. `percentage`, `flat`, or `flat_per_unit`).
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
     * Optionally supply a code (will be uppercased).
     * - Must be at least 3 characters if provided.
     * - If omitted, a random 16-character code is generated.
     */
    public function withCode(?string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * When the discount expires, if ever.
     */
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
     * List of product IDs to restrict usage (if any).
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
     * How many times this discount can be used (if any).
     * Must be >= 1 if provided.
     */
    public function withUsageLimit(?int $usageLimit): self
    {
        $self = clone $this;
        $self['usageLimit'] = $usageLimit;

        return $self;
    }
}
