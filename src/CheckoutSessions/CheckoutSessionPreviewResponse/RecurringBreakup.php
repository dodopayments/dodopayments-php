<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Breakup of recurring payments (None for one-time only).
 *
 * @phpstan-type RecurringBreakupShape = array{
 *   discount: int, subtotal: int, totalAmount: int, tax?: int|null
 * }
 */
final class RecurringBreakup implements BaseModel
{
    /** @use SdkModel<RecurringBreakupShape> */
    use SdkModel;

    /**
     * Total discount amount.
     */
    #[Required]
    public int $discount;

    /**
     * Subtotal before discount (pre-tax original prices).
     */
    #[Required]
    public int $subtotal;

    /**
     * Total recurring amount including tax.
     */
    #[Required('total_amount')]
    public int $totalAmount;

    /**
     * Total tax on recurring payments.
     */
    #[Optional(nullable: true)]
    public ?int $tax;

    /**
     * `new RecurringBreakup()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RecurringBreakup::with(discount: ..., subtotal: ..., totalAmount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RecurringBreakup)
     *   ->withDiscount(...)
     *   ->withSubtotal(...)
     *   ->withTotalAmount(...)
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
        int $discount,
        int $subtotal,
        int $totalAmount,
        ?int $tax = null
    ): self {
        $self = new self;

        $self['discount'] = $discount;
        $self['subtotal'] = $subtotal;
        $self['totalAmount'] = $totalAmount;

        null !== $tax && $self['tax'] = $tax;

        return $self;
    }

    /**
     * Total discount amount.
     */
    public function withDiscount(int $discount): self
    {
        $self = clone $this;
        $self['discount'] = $discount;

        return $self;
    }

    /**
     * Subtotal before discount (pre-tax original prices).
     */
    public function withSubtotal(int $subtotal): self
    {
        $self = clone $this;
        $self['subtotal'] = $subtotal;

        return $self;
    }

    /**
     * Total recurring amount including tax.
     */
    public function withTotalAmount(int $totalAmount): self
    {
        $self = clone $this;
        $self['totalAmount'] = $totalAmount;

        return $self;
    }

    /**
     * Total tax on recurring payments.
     */
    public function withTax(?int $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }
}
