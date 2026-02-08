<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\OnDemandSubscription;

/**
 * @phpstan-import-type OnDemandSubscriptionShape from \Dodopayments\Subscriptions\OnDemandSubscription
 *
 * @phpstan-type SubscriptionDataShape = array{
 *   onDemand?: null|OnDemandSubscription|OnDemandSubscriptionShape,
 *   trialPeriodDays?: int|null,
 * }
 */
final class SubscriptionData implements BaseModel
{
    /** @use SdkModel<SubscriptionDataShape> */
    use SdkModel;

    #[Optional('on_demand', nullable: true)]
    public ?OnDemandSubscription $onDemand;

    /**
     * Optional trial period in days If specified, this value overrides the trial period set in the product's price Must be between 0 and 10000 days.
     */
    #[Optional('trial_period_days', nullable: true)]
    public ?int $trialPeriodDays;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param OnDemandSubscription|OnDemandSubscriptionShape|null $onDemand
     */
    public static function with(
        OnDemandSubscription|array|null $onDemand = null,
        ?int $trialPeriodDays = null,
    ): self {
        $self = new self;

        null !== $onDemand && $self['onDemand'] = $onDemand;
        null !== $trialPeriodDays && $self['trialPeriodDays'] = $trialPeriodDays;

        return $self;
    }

    /**
     * @param OnDemandSubscription|OnDemandSubscriptionShape|null $onDemand
     */
    public function withOnDemand(
        OnDemandSubscription|array|null $onDemand
    ): self {
        $self = clone $this;
        $self['onDemand'] = $onDemand;

        return $self;
    }

    /**
     * Optional trial period in days If specified, this value overrides the trial period set in the product's price Must be between 0 and 10000 days.
     */
    public function withTrialPeriodDays(?int $trialPeriodDays): self
    {
        $self = clone $this;
        $self['trialPeriodDays'] = $trialPeriodDays;

        return $self;
    }
}
