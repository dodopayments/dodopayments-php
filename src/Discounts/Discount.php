<?php

declare(strict_types=1);

namespace Dodopayments\Discounts;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type discount_alias = array{
 *   amount: int,
 *   businessID: string,
 *   code: string,
 *   createdAt: \DateTimeInterface,
 *   discountID: string,
 *   restrictedTo: list<string>,
 *   timesUsed: int,
 *   type: value-of<DiscountType>,
 *   expiresAt?: \DateTimeInterface|null,
 *   name?: string|null,
 *   subscriptionCycles?: int|null,
 *   usageLimit?: int|null,
 * }
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class Discount implements BaseModel
{
    /** @use SdkModel<discount_alias> */
    use SdkModel;

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
    #[Api('business_id')]
    public string $businessID;

    /**
     * The discount code (up to 16 chars).
     */
    #[Api]
    public string $code;

    /**
     * Timestamp when the discount is created.
     */
    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The unique discount ID.
     */
    #[Api('discount_id')]
    public string $discountID;

    /**
     * List of product IDs to which this discount is restricted.
     *
     * @var list<string> $restrictedTo
     */
    #[Api('restricted_to', list: 'string')]
    public array $restrictedTo;

    /**
     * How many times this discount has been used.
     */
    #[Api('times_used')]
    public int $timesUsed;

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
    #[Api('expires_at', nullable: true, optional: true)]
    public ?\DateTimeInterface $expiresAt;

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
    #[Api('subscription_cycles', nullable: true, optional: true)]
    public ?int $subscriptionCycles;

    /**
     * Usage limit for this discount, if any.
     */
    #[Api('usage_limit', nullable: true, optional: true)]
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
     * @param list<string> $restrictedTo
     * @param DiscountType|value-of<DiscountType> $type
     */
    public static function with(
        int $amount,
        string $businessID,
        string $code,
        \DateTimeInterface $createdAt,
        string $discountID,
        array $restrictedTo,
        int $timesUsed,
        DiscountType|string $type,
        ?\DateTimeInterface $expiresAt = null,
        ?string $name = null,
        ?int $subscriptionCycles = null,
        ?int $usageLimit = null,
    ): self {
        $obj = new self;

        $obj->amount = $amount;
        $obj->businessID = $businessID;
        $obj->code = $code;
        $obj->createdAt = $createdAt;
        $obj->discountID = $discountID;
        $obj->restrictedTo = $restrictedTo;
        $obj->timesUsed = $timesUsed;
        $obj->type = $type instanceof DiscountType ? $type->value : $type;

        null !== $expiresAt && $obj->expiresAt = $expiresAt;
        null !== $name && $obj->name = $name;
        null !== $subscriptionCycles && $obj->subscriptionCycles = $subscriptionCycles;
        null !== $usageLimit && $obj->usageLimit = $usageLimit;

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
        $obj->amount = $amount;

        return $obj;
    }

    /**
     * The business this discount belongs to.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    /**
     * The discount code (up to 16 chars).
     */
    public function withCode(string $code): self
    {
        $obj = clone $this;
        $obj->code = $code;

        return $obj;
    }

    /**
     * Timestamp when the discount is created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * The unique discount ID.
     */
    public function withDiscountID(string $discountID): self
    {
        $obj = clone $this;
        $obj->discountID = $discountID;

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
        $obj->restrictedTo = $restrictedTo;

        return $obj;
    }

    /**
     * How many times this discount has been used.
     */
    public function withTimesUsed(int $timesUsed): self
    {
        $obj = clone $this;
        $obj->timesUsed = $timesUsed;

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
        $obj->type = $type instanceof DiscountType ? $type->value : $type;

        return $obj;
    }

    /**
     * Optional date/time after which discount is expired.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $obj = clone $this;
        $obj->expiresAt = $expiresAt;

        return $obj;
    }

    /**
     * Name for the Discount.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

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
        $obj->subscriptionCycles = $subscriptionCycles;

        return $obj;
    }

    /**
     * Usage limit for this discount, if any.
     */
    public function withUsageLimit(?int $usageLimit): self
    {
        $obj = clone $this;
        $obj->usageLimit = $usageLimit;

        return $obj;
    }
}
