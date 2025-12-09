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
        $obj = new self;

        $obj['amount'] = $amount;
        $obj['type'] = $type;

        null !== $code && $obj['code'] = $code;
        null !== $expiresAt && $obj['expiresAt'] = $expiresAt;
        null !== $name && $obj['name'] = $name;
        null !== $restrictedTo && $obj['restrictedTo'] = $restrictedTo;
        null !== $subscriptionCycles && $obj['subscriptionCycles'] = $subscriptionCycles;
        null !== $usageLimit && $obj['usageLimit'] = $usageLimit;

        return $obj;
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
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }

    /**
     * The discount type (e.g. `percentage`, `flat`, or `flat_per_unit`).
     *
     * @param DiscountType|value-of<DiscountType> $type
     */
    public function withType(DiscountType|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * Optionally supply a code (will be uppercased).
     * - Must be at least 3 characters if provided.
     * - If omitted, a random 16-character code is generated.
     */
    public function withCode(?string $code): self
    {
        $obj = clone $this;
        $obj['code'] = $code;

        return $obj;
    }

    /**
     * When the discount expires, if ever.
     */
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
     * List of product IDs to restrict usage (if any).
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
     * How many times this discount can be used (if any).
     * Must be >= 1 if provided.
     */
    public function withUsageLimit(?int $usageLimit): self
    {
        $obj = clone $this;
        $obj['usageLimit'] = $usageLimit;

        return $obj;
    }
}
