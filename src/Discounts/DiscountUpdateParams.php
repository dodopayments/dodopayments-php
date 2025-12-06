<?php

declare(strict_types=1);

namespace Dodopayments\Discounts;

use Dodopayments\Core\Attributes\Api;
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
 *   expires_at?: \DateTimeInterface|null,
 *   name?: string|null,
 *   restricted_to?: list<string>|null,
 *   subscription_cycles?: int|null,
 *   type?: null|DiscountType|value-of<DiscountType>,
 *   usage_limit?: int|null,
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
    #[Api(nullable: true, optional: true)]
    public ?int $amount;

    /**
     * If present, update the discount code (uppercase).
     */
    #[Api(nullable: true, optional: true)]
    public ?string $code;

    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $expires_at;

    #[Api(nullable: true, optional: true)]
    public ?string $name;

    /**
     * If present, replaces all restricted product IDs with this new set.
     * To remove all restrictions, send empty array.
     *
     * @var list<string>|null $restricted_to
     */
    #[Api(list: 'string', nullable: true, optional: true)]
    public ?array $restricted_to;

    /**
     * Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $subscription_cycles;

    /**
     * If present, update the discount type.
     *
     * @var value-of<DiscountType>|null $type
     */
    #[Api(enum: DiscountType::class, nullable: true, optional: true)]
    public ?string $type;

    #[Api(nullable: true, optional: true)]
    public ?int $usage_limit;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $restricted_to
     * @param DiscountType|value-of<DiscountType>|null $type
     */
    public static function with(
        ?int $amount = null,
        ?string $code = null,
        ?\DateTimeInterface $expires_at = null,
        ?string $name = null,
        ?array $restricted_to = null,
        ?int $subscription_cycles = null,
        DiscountType|string|null $type = null,
        ?int $usage_limit = null,
    ): self {
        $obj = new self;

        null !== $amount && $obj['amount'] = $amount;
        null !== $code && $obj['code'] = $code;
        null !== $expires_at && $obj['expires_at'] = $expires_at;
        null !== $name && $obj['name'] = $name;
        null !== $restricted_to && $obj['restricted_to'] = $restricted_to;
        null !== $subscription_cycles && $obj['subscription_cycles'] = $subscription_cycles;
        null !== $type && $obj['type'] = $type;
        null !== $usage_limit && $obj['usage_limit'] = $usage_limit;

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
        $obj['expires_at'] = $expiresAt;

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
        $obj['restricted_to'] = $restrictedTo;

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
        $obj['usage_limit'] = $usageLimit;

        return $obj;
    }
}
