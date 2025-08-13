<?php

declare(strict_types=1);

namespace DodoPayments\Discounts;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Core\Conversion\ListOf;

/**
 * @phpstan-type discount_alias = array{
 *   amount: int,
 *   businessID: string,
 *   code: string,
 *   createdAt: \DateTimeInterface,
 *   discountID: string,
 *   restrictedTo: list<string>,
 *   timesUsed: int,
 *   type: DiscountType::*,
 *   expiresAt?: \DateTimeInterface|null,
 *   name?: string|null,
 *   subscriptionCycles?: int|null,
 *   usageLimit?: int|null,
 * }
 */
final class Discount implements BaseModel
{
    use Model;

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
    #[Api('restricted_to', type: new ListOf('string'))]
    public array $restrictedTo;

    /**
     * How many times this discount has been used.
     */
    #[Api('times_used')]
    public int $timesUsed;

    /**
     * The type of discount, e.g. `percentage`, `flat`, or `flat_per_unit`.
     *
     * @var DiscountType::* $type
     */
    #[Api(enum: DiscountType::class)]
    public string $type;

    /**
     * Optional date/time after which discount is expired.
     */
    #[Api('expires_at', optional: true)]
    public ?\DateTimeInterface $expiresAt;

    /**
     * Name for the Discount.
     */
    #[Api(optional: true)]
    public ?string $name;

    /**
     * Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     */
    #[Api('subscription_cycles', optional: true)]
    public ?int $subscriptionCycles;

    /**
     * Usage limit for this discount, if any.
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
     * @param list<string> $restrictedTo
     * @param DiscountType::* $type
     */
    public static function from(
        int $amount,
        string $businessID,
        string $code,
        \DateTimeInterface $createdAt,
        string $discountID,
        array $restrictedTo,
        int $timesUsed,
        string $type,
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
        $obj->type = $type;

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
    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * The business this discount belongs to.
     */
    public function setBusinessID(string $businessID): self
    {
        $this->businessID = $businessID;

        return $this;
    }

    /**
     * The discount code (up to 16 chars).
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Timestamp when the discount is created.
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * The unique discount ID.
     */
    public function setDiscountID(string $discountID): self
    {
        $this->discountID = $discountID;

        return $this;
    }

    /**
     * List of product IDs to which this discount is restricted.
     *
     * @param list<string> $restrictedTo
     */
    public function setRestrictedTo(array $restrictedTo): self
    {
        $this->restrictedTo = $restrictedTo;

        return $this;
    }

    /**
     * How many times this discount has been used.
     */
    public function setTimesUsed(int $timesUsed): self
    {
        $this->timesUsed = $timesUsed;

        return $this;
    }

    /**
     * The type of discount, e.g. `percentage`, `flat`, or `flat_per_unit`.
     *
     * @param DiscountType::* $type
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Optional date/time after which discount is expired.
     */
    public function setExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Name for the Discount.
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

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
     * Usage limit for this discount, if any.
     */
    public function setUsageLimit(?int $usageLimit): self
    {
        $this->usageLimit = $usageLimit;

        return $this;
    }
}
