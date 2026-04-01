<?php

declare(strict_types=1);

namespace Dodopayments\Payouts\Breakup;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Payout breakup aggregated by event type, with amounts in the payout's currency.
 *
 * @phpstan-type BreakupGetResponseItemShape = array{eventType: string, total: int}
 */
final class BreakupGetResponseItem implements BaseModel
{
    /** @use SdkModel<BreakupGetResponseItemShape> */
    use SdkModel;

    /**
     * The type of balance ledger event (e.g., "payment", "refund", "dispute", "payment_fees").
     */
    #[Required('event_type')]
    public string $eventType;

    /**
     * Total amount for this event type in the payout's currency (in smallest currency unit, e.g., cents).
     */
    #[Required]
    public int $total;

    /**
     * `new BreakupGetResponseItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BreakupGetResponseItem::with(eventType: ..., total: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BreakupGetResponseItem)->withEventType(...)->withTotal(...)
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
    public static function with(string $eventType, int $total): self
    {
        $self = new self;

        $self['eventType'] = $eventType;
        $self['total'] = $total;

        return $self;
    }

    /**
     * The type of balance ledger event (e.g., "payment", "refund", "dispute", "payment_fees").
     */
    public function withEventType(string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * Total amount for this event type in the payout's currency (in smallest currency unit, e.g., cents).
     */
    public function withTotal(int $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }
}
