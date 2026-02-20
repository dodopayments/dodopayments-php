<?php

declare(strict_types=1);

namespace Dodopayments\Products\ProductUpdateParams;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Products\ProductUpdateParams\CreditEntitlement\ProrationBehavior;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * Request struct for attaching a credit entitlement to a product.
 *
 * @phpstan-type CreditEntitlementShape = array{
 *   creditEntitlementID: string,
 *   creditsAmount: string,
 *   creditsReduceOverage?: bool|null,
 *   currency?: null|Currency|value-of<Currency>,
 *   expiresAfterDays?: int|null,
 *   lowBalanceThresholdPercent?: int|null,
 *   maxRolloverCount?: int|null,
 *   overageChargeAtBilling?: bool|null,
 *   overageEnabled?: bool|null,
 *   overageLimit?: string|null,
 *   preserveOverageAtReset?: bool|null,
 *   pricePerUnit?: string|null,
 *   prorationBehavior?: null|ProrationBehavior|value-of<ProrationBehavior>,
 *   rolloverEnabled?: bool|null,
 *   rolloverPercentage?: int|null,
 *   rolloverTimeframeCount?: int|null,
 *   rolloverTimeframeInterval?: null|TimeInterval|value-of<TimeInterval>,
 *   trialCredits?: string|null,
 *   trialCreditsExpireAfterTrial?: bool|null,
 * }
 */
final class CreditEntitlement implements BaseModel
{
    /** @use SdkModel<CreditEntitlementShape> */
    use SdkModel;

    /**
     * ID of the credit entitlement to attach.
     */
    #[Required('credit_entitlement_id')]
    public string $creditEntitlementID;

    /**
     * Number of credits to grant when this product is purchased.
     */
    #[Required('credits_amount')]
    public string $creditsAmount;

    /**
     * Whether new credit grants reduce existing overage.
     */
    #[Optional('credits_reduce_overage', nullable: true)]
    public ?bool $creditsReduceOverage;

    /**
     * Currency for credit-related pricing.
     *
     * @var value-of<Currency>|null $currency
     */
    #[Optional(enum: Currency::class, nullable: true)]
    public ?string $currency;

    /**
     * Number of days after which credits expire.
     */
    #[Optional('expires_after_days', nullable: true)]
    public ?int $expiresAfterDays;

    /**
     * Balance threshold percentage for low balance notifications (0-100).
     */
    #[Optional('low_balance_threshold_percent', nullable: true)]
    public ?int $lowBalanceThresholdPercent;

    /**
     * Maximum number of rollover cycles allowed.
     */
    #[Optional('max_rollover_count', nullable: true)]
    public ?int $maxRolloverCount;

    /**
     * Whether overage charges are applied at billing time.
     */
    #[Optional('overage_charge_at_billing', nullable: true)]
    public ?bool $overageChargeAtBilling;

    /**
     * Whether overage usage is allowed beyond credit balance.
     */
    #[Optional('overage_enabled', nullable: true)]
    public ?bool $overageEnabled;

    /**
     * Maximum amount of overage allowed.
     */
    #[Optional('overage_limit', nullable: true)]
    public ?string $overageLimit;

    /**
     * Whether to preserve overage balance when credits reset.
     */
    #[Optional('preserve_overage_at_reset', nullable: true)]
    public ?bool $preserveOverageAtReset;

    /**
     * Price per credit unit for purchasing additional credits.
     */
    #[Optional('price_per_unit', nullable: true)]
    public ?string $pricePerUnit;

    /**
     * Proration behavior for credit grants during plan changes.
     *
     * @var value-of<ProrationBehavior>|null $prorationBehavior
     */
    #[Optional(
        'proration_behavior',
        enum: ProrationBehavior::class,
        nullable: true
    )]
    public ?string $prorationBehavior;

    /**
     * Whether unused credits can roll over to the next billing period.
     */
    #[Optional('rollover_enabled', nullable: true)]
    public ?bool $rolloverEnabled;

    /**
     * Percentage of unused credits that can roll over (0-100).
     */
    #[Optional('rollover_percentage', nullable: true)]
    public ?int $rolloverPercentage;

    /**
     * Number of timeframe units for rollover window.
     */
    #[Optional('rollover_timeframe_count', nullable: true)]
    public ?int $rolloverTimeframeCount;

    /**
     * Time interval for rollover window (day, week, month, year).
     *
     * @var value-of<TimeInterval>|null $rolloverTimeframeInterval
     */
    #[Optional(
        'rollover_timeframe_interval',
        enum: TimeInterval::class,
        nullable: true
    )]
    public ?string $rolloverTimeframeInterval;

    /**
     * Credits granted during trial period.
     */
    #[Optional('trial_credits', nullable: true)]
    public ?string $trialCredits;

    /**
     * Whether trial credits expire when trial ends.
     */
    #[Optional('trial_credits_expire_after_trial', nullable: true)]
    public ?bool $trialCreditsExpireAfterTrial;

    /**
     * `new CreditEntitlement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditEntitlement::with(creditEntitlementID: ..., creditsAmount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditEntitlement)->withCreditEntitlementID(...)->withCreditsAmount(...)
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
     *
     * @param Currency|value-of<Currency>|null $currency
     * @param ProrationBehavior|value-of<ProrationBehavior>|null $prorationBehavior
     * @param TimeInterval|value-of<TimeInterval>|null $rolloverTimeframeInterval
     */
    public static function with(
        string $creditEntitlementID,
        string $creditsAmount,
        ?bool $creditsReduceOverage = null,
        Currency|string|null $currency = null,
        ?int $expiresAfterDays = null,
        ?int $lowBalanceThresholdPercent = null,
        ?int $maxRolloverCount = null,
        ?bool $overageChargeAtBilling = null,
        ?bool $overageEnabled = null,
        ?string $overageLimit = null,
        ?bool $preserveOverageAtReset = null,
        ?string $pricePerUnit = null,
        ProrationBehavior|string|null $prorationBehavior = null,
        ?bool $rolloverEnabled = null,
        ?int $rolloverPercentage = null,
        ?int $rolloverTimeframeCount = null,
        TimeInterval|string|null $rolloverTimeframeInterval = null,
        ?string $trialCredits = null,
        ?bool $trialCreditsExpireAfterTrial = null,
    ): self {
        $self = new self;

        $self['creditEntitlementID'] = $creditEntitlementID;
        $self['creditsAmount'] = $creditsAmount;

        null !== $creditsReduceOverage && $self['creditsReduceOverage'] = $creditsReduceOverage;
        null !== $currency && $self['currency'] = $currency;
        null !== $expiresAfterDays && $self['expiresAfterDays'] = $expiresAfterDays;
        null !== $lowBalanceThresholdPercent && $self['lowBalanceThresholdPercent'] = $lowBalanceThresholdPercent;
        null !== $maxRolloverCount && $self['maxRolloverCount'] = $maxRolloverCount;
        null !== $overageChargeAtBilling && $self['overageChargeAtBilling'] = $overageChargeAtBilling;
        null !== $overageEnabled && $self['overageEnabled'] = $overageEnabled;
        null !== $overageLimit && $self['overageLimit'] = $overageLimit;
        null !== $preserveOverageAtReset && $self['preserveOverageAtReset'] = $preserveOverageAtReset;
        null !== $pricePerUnit && $self['pricePerUnit'] = $pricePerUnit;
        null !== $prorationBehavior && $self['prorationBehavior'] = $prorationBehavior;
        null !== $rolloverEnabled && $self['rolloverEnabled'] = $rolloverEnabled;
        null !== $rolloverPercentage && $self['rolloverPercentage'] = $rolloverPercentage;
        null !== $rolloverTimeframeCount && $self['rolloverTimeframeCount'] = $rolloverTimeframeCount;
        null !== $rolloverTimeframeInterval && $self['rolloverTimeframeInterval'] = $rolloverTimeframeInterval;
        null !== $trialCredits && $self['trialCredits'] = $trialCredits;
        null !== $trialCreditsExpireAfterTrial && $self['trialCreditsExpireAfterTrial'] = $trialCreditsExpireAfterTrial;

        return $self;
    }

    /**
     * ID of the credit entitlement to attach.
     */
    public function withCreditEntitlementID(string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }

    /**
     * Number of credits to grant when this product is purchased.
     */
    public function withCreditsAmount(string $creditsAmount): self
    {
        $self = clone $this;
        $self['creditsAmount'] = $creditsAmount;

        return $self;
    }

    /**
     * Whether new credit grants reduce existing overage.
     */
    public function withCreditsReduceOverage(?bool $creditsReduceOverage): self
    {
        $self = clone $this;
        $self['creditsReduceOverage'] = $creditsReduceOverage;

        return $self;
    }

    /**
     * Currency for credit-related pricing.
     *
     * @param Currency|value-of<Currency>|null $currency
     */
    public function withCurrency(Currency|string|null $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Number of days after which credits expire.
     */
    public function withExpiresAfterDays(?int $expiresAfterDays): self
    {
        $self = clone $this;
        $self['expiresAfterDays'] = $expiresAfterDays;

        return $self;
    }

    /**
     * Balance threshold percentage for low balance notifications (0-100).
     */
    public function withLowBalanceThresholdPercent(
        ?int $lowBalanceThresholdPercent
    ): self {
        $self = clone $this;
        $self['lowBalanceThresholdPercent'] = $lowBalanceThresholdPercent;

        return $self;
    }

    /**
     * Maximum number of rollover cycles allowed.
     */
    public function withMaxRolloverCount(?int $maxRolloverCount): self
    {
        $self = clone $this;
        $self['maxRolloverCount'] = $maxRolloverCount;

        return $self;
    }

    /**
     * Whether overage charges are applied at billing time.
     */
    public function withOverageChargeAtBilling(
        ?bool $overageChargeAtBilling
    ): self {
        $self = clone $this;
        $self['overageChargeAtBilling'] = $overageChargeAtBilling;

        return $self;
    }

    /**
     * Whether overage usage is allowed beyond credit balance.
     */
    public function withOverageEnabled(?bool $overageEnabled): self
    {
        $self = clone $this;
        $self['overageEnabled'] = $overageEnabled;

        return $self;
    }

    /**
     * Maximum amount of overage allowed.
     */
    public function withOverageLimit(?string $overageLimit): self
    {
        $self = clone $this;
        $self['overageLimit'] = $overageLimit;

        return $self;
    }

    /**
     * Whether to preserve overage balance when credits reset.
     */
    public function withPreserveOverageAtReset(
        ?bool $preserveOverageAtReset
    ): self {
        $self = clone $this;
        $self['preserveOverageAtReset'] = $preserveOverageAtReset;

        return $self;
    }

    /**
     * Price per credit unit for purchasing additional credits.
     */
    public function withPricePerUnit(?string $pricePerUnit): self
    {
        $self = clone $this;
        $self['pricePerUnit'] = $pricePerUnit;

        return $self;
    }

    /**
     * Proration behavior for credit grants during plan changes.
     *
     * @param ProrationBehavior|value-of<ProrationBehavior>|null $prorationBehavior
     */
    public function withProrationBehavior(
        ProrationBehavior|string|null $prorationBehavior
    ): self {
        $self = clone $this;
        $self['prorationBehavior'] = $prorationBehavior;

        return $self;
    }

    /**
     * Whether unused credits can roll over to the next billing period.
     */
    public function withRolloverEnabled(?bool $rolloverEnabled): self
    {
        $self = clone $this;
        $self['rolloverEnabled'] = $rolloverEnabled;

        return $self;
    }

    /**
     * Percentage of unused credits that can roll over (0-100).
     */
    public function withRolloverPercentage(?int $rolloverPercentage): self
    {
        $self = clone $this;
        $self['rolloverPercentage'] = $rolloverPercentage;

        return $self;
    }

    /**
     * Number of timeframe units for rollover window.
     */
    public function withRolloverTimeframeCount(
        ?int $rolloverTimeframeCount
    ): self {
        $self = clone $this;
        $self['rolloverTimeframeCount'] = $rolloverTimeframeCount;

        return $self;
    }

    /**
     * Time interval for rollover window (day, week, month, year).
     *
     * @param TimeInterval|value-of<TimeInterval>|null $rolloverTimeframeInterval
     */
    public function withRolloverTimeframeInterval(
        TimeInterval|string|null $rolloverTimeframeInterval
    ): self {
        $self = clone $this;
        $self['rolloverTimeframeInterval'] = $rolloverTimeframeInterval;

        return $self;
    }

    /**
     * Credits granted during trial period.
     */
    public function withTrialCredits(?string $trialCredits): self
    {
        $self = clone $this;
        $self['trialCredits'] = $trialCredits;

        return $self;
    }

    /**
     * Whether trial credits expire when trial ends.
     */
    public function withTrialCreditsExpireAfterTrial(
        ?bool $trialCreditsExpireAfterTrial
    ): self {
        $self = clone $this;
        $self['trialCreditsExpireAfterTrial'] = $trialCreditsExpireAfterTrial;

        return $self;
    }
}
