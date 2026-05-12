<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionListResponse;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Lightweight discount info for list endpoints.
 * Array order represents position (no explicit position field).
 *
 * @phpstan-type DiscountShape = array{
 *   discountID: string, discountCyclesRemaining?: int|null
 * }
 */
final class Discount implements BaseModel
{
    /** @use SdkModel<DiscountShape> */
    use SdkModel;

    /**
     * The unique discount ID.
     */
    #[Required('discount_id')]
    public string $discountID;

    /**
     * Remaining billing cycles for this discount on this subscription.
     */
    #[Optional('discount_cycles_remaining', nullable: true)]
    public ?int $discountCyclesRemaining;

    /**
     * `new Discount()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Discount::with(discountID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Discount)->withDiscountID(...)
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
     */
    public static function with(
        string $discountID,
        ?int $discountCyclesRemaining = null
    ): self {
        $self = new self;

        $self['discountID'] = $discountID;

        null !== $discountCyclesRemaining && $self['discountCyclesRemaining'] = $discountCyclesRemaining;

        return $self;
    }

    /**
     * The unique discount ID.
     */
    public function withDiscountID(string $discountID): self
    {
        $self = clone $this;
        $self['discountID'] = $discountID;

        return $self;
    }

    /**
     * Remaining billing cycles for this discount on this subscription.
     */
    public function withDiscountCyclesRemaining(
        ?int $discountCyclesRemaining
    ): self {
        $self = clone $this;
        $self['discountCyclesRemaining'] = $discountCyclesRemaining;

        return $self;
    }
}
