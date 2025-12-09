<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionRequest;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
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
     * @param OnDemandSubscription|array{
     *   mandateOnly: bool,
     *   adaptiveCurrencyFeesInclusive?: bool|null,
     *   productCurrency?: value-of<Currency>|null,
     *   productDescription?: string|null,
     *   productPrice?: int|null,
     * }|null $onDemand
     */
    public static function with(
        OnDemandSubscription|array|null $onDemand = null,
        ?int $trialPeriodDays = null,
    ): self {
        $obj = new self;

        null !== $onDemand && $obj['onDemand'] = $onDemand;
        null !== $trialPeriodDays && $obj['trialPeriodDays'] = $trialPeriodDays;

        return $obj;
    }

    /**
     * @param OnDemandSubscription|array{
     *   mandateOnly: bool,
     *   adaptiveCurrencyFeesInclusive?: bool|null,
     *   productCurrency?: value-of<Currency>|null,
     *   productDescription?: string|null,
     *   productPrice?: int|null,
     * }|null $onDemand
     */
    public function withOnDemand(
        OnDemandSubscription|array|null $onDemand
    ): self {
        $obj = clone $this;
        $obj['onDemand'] = $onDemand;

        return $obj;
    }

    /**
     * Optional trial period in days If specified, this value overrides the trial period set in the product's price Must be between 0 and 10000 days.
     */
    public function withTrialPeriodDays(?int $trialPeriodDays): self
    {
        $obj = clone $this;
        $obj['trialPeriodDays'] = $trialPeriodDays;

        return $obj;
    }
}
