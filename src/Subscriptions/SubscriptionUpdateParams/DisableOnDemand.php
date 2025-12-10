<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionUpdateParams;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type DisableOnDemandShape = array{nextBillingDate: \DateTimeInterface}
 */
final class DisableOnDemand implements BaseModel
{
    /** @use SdkModel<DisableOnDemandShape> */
    use SdkModel;

    #[Required('next_billing_date')]
    public \DateTimeInterface $nextBillingDate;

    /**
     * `new DisableOnDemand()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DisableOnDemand::with(nextBillingDate: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DisableOnDemand)->withNextBillingDate(...)
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
    public static function with(\DateTimeInterface $nextBillingDate): self
    {
        $self = new self;

        $self['nextBillingDate'] = $nextBillingDate;

        return $self;
    }

    public function withNextBillingDate(
        \DateTimeInterface $nextBillingDate
    ): self {
        $self = clone $this;
        $self['nextBillingDate'] = $nextBillingDate;

        return $self;
    }
}
