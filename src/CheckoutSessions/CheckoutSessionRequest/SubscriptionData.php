<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionRequest;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\OnDemandSubscription;

/**
 * @phpstan-type SubscriptionDataShape = array{
 *   on_demand?: OnDemandSubscription|null, trial_period_days?: int|null
 * }
 */
final class SubscriptionData implements BaseModel
{
    /** @use SdkModel<SubscriptionDataShape> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?OnDemandSubscription $on_demand;

    /**
     * Optional trial period in days If specified, this value overrides the trial period set in the product's price Must be between 0 and 10000 days.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $trial_period_days;

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
        ?OnDemandSubscription $on_demand = null,
        ?int $trial_period_days = null
    ): self {
        $obj = new self;

        null !== $on_demand && $obj->on_demand = $on_demand;
        null !== $trial_period_days && $obj->trial_period_days = $trial_period_days;

        return $obj;
    }

    public function withOnDemand(?OnDemandSubscription $onDemand): self
    {
        $obj = clone $this;
        $obj->on_demand = $onDemand;

        return $obj;
    }

    /**
     * Optional trial period in days If specified, this value overrides the trial period set in the product's price Must be between 0 and 10000 days.
     */
    public function withTrialPeriodDays(?int $trialPeriodDays): self
    {
        $obj = clone $this;
        $obj->trial_period_days = $trialPeriodDays;

        return $obj;
    }
}
