<?php

declare(strict_types=1);

namespace DodopaymentsClient\Discounts;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Concerns\Params;
use DodopaymentsClient\Core\Contracts\BaseModel;
use DodopaymentsClient\Core\Conversion\ListOf;

/**
 * PATCH /discounts/{discount_id}.
 *
 * @phpstan-type update_params = array{
 *   amount?: int|null,
 *   code?: string|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   name?: string|null,
 *   restrictedTo?: list<string>|null,
 *   subscriptionCycles?: int|null,
 *   type?: DiscountType::*,
 *   usageLimit?: int|null,
 * }
 */
final class DiscountUpdateParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * If present, update the discount amount:
     * - If `discount_type` is `percentage`, this represents **basis points** (e.g., `540` = `5.4%`).
     * - Otherwise, this represents **USD cents** (e.g., `100` = `$1.00`).
     *
     * Must be at least 1 if provided.
     */
    #[Api(optional: true)]
    public ?int $amount;

    /**
     * If present, update the discount code (uppercase).
     */
    #[Api(optional: true)]
    public ?string $code;

    #[Api('expires_at', optional: true)]
    public ?\DateTimeInterface $expiresAt;

    #[Api(optional: true)]
    public ?string $name;

    /**
     * If present, replaces all restricted product IDs with this new set.
     * To remove all restrictions, send empty array.
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
     * If present, update the discount type.
     *
     * @var null|DiscountType::* $type
     */
    #[Api(enum: DiscountType::class, optional: true)]
    public ?string $type;

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
     * @param null|list<string> $restrictedTo
     * @param DiscountType::* $type
     */
    public static function from(
        ?int $amount = null,
        ?string $code = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $name = null,
        ?array $restrictedTo = null,
        ?int $subscriptionCycles = null,
        ?string $type = null,
        ?int $usageLimit = null,
    ): self {
        $obj = new self;

        null !== $amount && $obj->amount = $amount;
        null !== $code && $obj->code = $code;
        null !== $expiresAt && $obj->expiresAt = $expiresAt;
        null !== $name && $obj->name = $name;
        null !== $restrictedTo && $obj->restrictedTo = $restrictedTo;
        null !== $subscriptionCycles && $obj->subscriptionCycles = $subscriptionCycles;
        null !== $type && $obj->type = $type;
        null !== $usageLimit && $obj->usageLimit = $usageLimit;

        return $obj;
    }

    /**
     * If present, update the discount amount:
     * - If `discount_type` is `percentage`, this represents **basis points** (e.g., `540` = `5.4%`).
     * - Otherwise, this represents **USD cents** (e.g., `100` = `$1.00`).
     *
     * Must be at least 1 if provided.
     */
    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * If present, update the discount code (uppercase).
     */
    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

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
     * If present, replaces all restricted product IDs with this new set.
     * To remove all restrictions, send empty array.
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
     * If present, update the discount type.
     *
     * @param DiscountType::* $type
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setUsageLimit(?int $usageLimit): self
    {
        $this->usageLimit = $usageLimit;

        return $this;
    }
}
