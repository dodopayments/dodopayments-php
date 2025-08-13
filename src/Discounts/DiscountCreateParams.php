<?php

declare(strict_types=1);

namespace Dodopayments\Discounts;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Concerns\Params;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\ListOf;

/**
 * POST /discounts
 * If `code` is omitted or empty, a random 16-char uppercase code is generated.
 *
 * @phpstan-type create_params = array{
 *   amount: int,
 *   type: DiscountType::*,
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
    use Model;
    use Params;

    /**
     * The discount amount.
     *
     * - If `discount_type` is **not** `percentage`, `amount` is in **USD cents**. For example, `100` means `$1.00`.
     *   Only USD is allowed.
     * - If `discount_type` **is** `percentage`, `amount` is in **basis points**. For example, `540` means `5.4%`.
     *
     * Must be at least 1.
     */
    #[Api]
    public int $amount;

    /**
     * The discount type (e.g. `percentage`, `flat`, or `flat_per_unit`).
     *
     * @var DiscountType::* $type
     */
    #[Api(enum: DiscountType::class)]
    public string $type;

    /**
     * Optionally supply a code (will be uppercased).
     * - Must be at least 3 characters if provided.
     * - If omitted, a random 16-character code is generated.
     */
    #[Api(optional: true)]
    public ?string $code;

    /**
     * When the discount expires, if ever.
     */
    #[Api('expires_at', optional: true)]
    public ?\DateTimeInterface $expiresAt;

    #[Api(optional: true)]
    public ?string $name;

    /**
     * List of product IDs to restrict usage (if any).
     *
     * @var null|list<string> $restrictedTo
     */
    #[Api(
        'restricted_to',
        type: new ListOf('string'),
        nullable: true,
        optional: true
    )]
    public ?array $restrictedTo;

    /**
     * Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     */
    #[Api('subscription_cycles', optional: true)]
    public ?int $subscriptionCycles;

    /**
     * How many times this discount can be used (if any).
     * Must be >= 1 if provided.
     */
    #[Api('usage_limit', optional: true)]
    public ?int $usageLimit;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param DiscountType::* $type
     * @param null|list<string> $restrictedTo
     */
    public static function from(
        int $amount,
        string $type,
        ?string $code = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $name = null,
        ?array $restrictedTo = null,
        ?int $subscriptionCycles = null,
        ?int $usageLimit = null,
    ): self {
        $obj = new self;

        $obj->amount = $amount;
        $obj->type = $type;

        null !== $code && $obj->code = $code;
        null !== $expiresAt && $obj->expiresAt = $expiresAt;
        null !== $name && $obj->name = $name;
        null !== $restrictedTo && $obj->restrictedTo = $restrictedTo;
        null !== $subscriptionCycles && $obj->subscriptionCycles = $subscriptionCycles;
        null !== $usageLimit && $obj->usageLimit = $usageLimit;

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
    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * The discount type (e.g. `percentage`, `flat`, or `flat_per_unit`).
     *
     * @param DiscountType::* $type
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Optionally supply a code (will be uppercased).
     * - Must be at least 3 characters if provided.
     * - If omitted, a random 16-character code is generated.
     */
    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * When the discount expires, if ever.
     */
    public function setExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * List of product IDs to restrict usage (if any).
     *
     * @param null|list<string> $restrictedTo
     */
    public function setRestrictedTo(?array $restrictedTo): self
    {
        $this->restrictedTo = $restrictedTo;

        return $this;
    }

    /**
     * Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     */
    public function setSubscriptionCycles(?int $subscriptionCycles): self
    {
        $this->subscriptionCycles = $subscriptionCycles;

        return $this;
    }

    /**
     * How many times this discount can be used (if any).
     * Must be >= 1 if provided.
     */
    public function setUsageLimit(?int $usageLimit): self
    {
        $this->usageLimit = $usageLimit;

        return $this;
    }
}
