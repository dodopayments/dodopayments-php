<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionCreateParams;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\OnDemandSubscription;

/**
 * @phpstan-type SubscriptionDataShape = array{
 *   onDemand?: OnDemandSubscription|null, trialPeriodDays?: int|null
 * }
 */
final class SubscriptionData implements BaseModel
{
    /** @use SdkModel<SubscriptionDataShape> */
    use SdkModel;

    #[Api('on_demand', nullable: true, optional: true)]
    public ?OnDemandSubscription $onDemand;

    /**
     * Optional trial period in days If specified, this value overrides the trial period set in the product's price Must be between 0 and 10000 days.
     */
    #[Api('trial_period_days', nullable: true, optional: true)]
    public ?int $trialPeriodDays;

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
        ?OnDemandSubscription $onDemand = null,
        ?int $trialPeriodDays = null
    ): self {
        $obj = new self;

        null !== $onDemand && $obj->onDemand = $onDemand;
        null !== $trialPeriodDays && $obj->trialPeriodDays = $trialPeriodDays;

        return $obj;
    }

    public function withOnDemand(?OnDemandSubscription $onDemand): self
    {
        $obj = clone $this;
        $obj->onDemand = $onDemand;

        return $obj;
    }

    /**
     * Optional trial period in days If specified, this value overrides the trial period set in the product's price Must be between 0 and 10000 days.
     */
    public function withTrialPeriodDays(?int $trialPeriodDays): self
    {
        $obj = clone $this;
        $obj->trialPeriodDays = $trialPeriodDays;

        return $obj;
    }
}
