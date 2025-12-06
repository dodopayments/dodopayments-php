<?php

declare(strict_types=1);

namespace Dodopayments\Discounts;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type DiscountShape = array{
 *   amount: int,
 *   business_id: string,
 *   code: string,
 *   created_at: \DateTimeInterface,
 *   discount_id: string,
 *   restricted_to: list<string>,
 *   times_used: int,
 *   type: value-of<DiscountType>,
 *   expires_at?: \DateTimeInterface|null,
 *   name?: string|null,
 *   subscription_cycles?: int|null,
 *   usage_limit?: int|null,
 * }
 */
final class Discount implements BaseModel, ResponseConverter
{
    /** @use SdkModel<DiscountShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * The discount amount.
     *
     * - If `discount_type` is `percentage`, this is in **basis points**
     *   (e.g., 540 => 5.4%).
     * - Otherwise, this is **USD cents** (e.g., 100 => `$1.00`).
     */
    #[Api]
    public int $amount;

    /**
     * The business this discount belongs to.
     */
    #[Api]
    public string $business_id;

    /**
     * The discount code (up to 16 chars).
     */
    #[Api]
    public string $code;

    /**
     * Timestamp when the discount is created.
     */
    #[Api]
    public \DateTimeInterface $created_at;

    /**
     * The unique discount ID.
     */
    #[Api]
    public string $discount_id;

    /**
     * List of product IDs to which this discount is restricted.
     *
     * @var list<string> $restricted_to
     */
    #[Api(list: 'string')]
    public array $restricted_to;

    /**
     * How many times this discount has been used.
     */
    #[Api]
    public int $times_used;

    /**
     * The type of discount, e.g. `percentage`, `flat`, or `flat_per_unit`.
     *
     * @var value-of<DiscountType> $type
     */
    #[Api(enum: DiscountType::class)]
    public string $type;

    /**
     * Optional date/time after which discount is expired.
     */
    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $expires_at;

    /**
     * Name for the Discount.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $name;

    /**
     * Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $subscription_cycles;

    /**
     * Usage limit for this discount, if any.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $usage_limit;

    /**
     * `new Discount()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Discount::with(
     *   amount: ...,
     *   business_id: ...,
     *   code: ...,
     *   created_at: ...,
     *   discount_id: ...,
     *   restricted_to: ...,
     *   times_used: ...,
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
     * @param list<string> $restricted_to
     * @param DiscountType|value-of<DiscountType> $type
     */
    public static function with(
        int $amount,
        string $business_id,
        string $code,
        \DateTimeInterface $created_at,
        string $discount_id,
        array $restricted_to,
        int $times_used,
        DiscountType|string $type,
        ?\DateTimeInterface $expires_at = null,
        ?string $name = null,
        ?int $subscription_cycles = null,
        ?int $usage_limit = null,
    ): self {
        $obj = new self;

        $obj['amount'] = $amount;
        $obj['business_id'] = $business_id;
        $obj['code'] = $code;
        $obj['created_at'] = $created_at;
        $obj['discount_id'] = $discount_id;
        $obj['restricted_to'] = $restricted_to;
        $obj['times_used'] = $times_used;
        $obj['type'] = $type;

        null !== $expires_at && $obj['expires_at'] = $expires_at;
        null !== $name && $obj['name'] = $name;
        null !== $subscription_cycles && $obj['subscription_cycles'] = $subscription_cycles;
        null !== $usage_limit && $obj['usage_limit'] = $usage_limit;

        return $obj;
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
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }

    /**
     * The business this discount belongs to.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['business_id'] = $businessID;

        return $obj;
    }

    /**
     * The discount code (up to 16 chars).
     */
    public function withCode(string $code): self
    {
        $obj = clone $this;
        $obj['code'] = $code;

        return $obj;
    }

    /**
     * Timestamp when the discount is created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * The unique discount ID.
     */
    public function withDiscountID(string $discountID): self
    {
        $obj = clone $this;
        $obj['discount_id'] = $discountID;

        return $obj;
    }

    /**
     * List of product IDs to which this discount is restricted.
     *
     * @param list<string> $restrictedTo
     */
    public function withRestrictedTo(array $restrictedTo): self
    {
        $obj = clone $this;
        $obj['restricted_to'] = $restrictedTo;

        return $obj;
    }

    /**
     * How many times this discount has been used.
     */
    public function withTimesUsed(int $timesUsed): self
    {
        $obj = clone $this;
        $obj['times_used'] = $timesUsed;

        return $obj;
    }

    /**
     * The type of discount, e.g. `percentage`, `flat`, or `flat_per_unit`.
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
     * Optional date/time after which discount is expired.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $obj = clone $this;
        $obj['expires_at'] = $expiresAt;

        return $obj;
    }

    /**
     * Name for the Discount.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

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
        $obj['subscription_cycles'] = $subscriptionCycles;

        return $obj;
    }

    /**
     * Usage limit for this discount, if any.
     */
    public function withUsageLimit(?int $usageLimit): self
    {
        $obj = clone $this;
        $obj['usage_limit'] = $usageLimit;

        return $obj;
    }
}
