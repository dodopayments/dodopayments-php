<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\CreditEntitlements\CbbOverageBehavior;
use Dodopayments\Misc\Currency;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * Response struct for credit entitlement mapping.
 *
 * @phpstan-type CreditEntitlementMappingResponseShape = array{
 *   id: string,
 *   creditEntitlementID: string,
 *   creditEntitlementName: string,
 *   creditEntitlementUnit: string,
 *   creditsAmount: string,
 *   overageBehavior: CbbOverageBehavior|value-of<CbbOverageBehavior>,
 *   overageEnabled: bool,
 *   prorationBehavior: CbbProrationBehavior|value-of<CbbProrationBehavior>,
 *   rolloverEnabled: bool,
 *   trialCreditsExpireAfterTrial: bool,
 *   currency?: null|Currency|value-of<Currency>,
 *   expiresAfterDays?: int|null,
 *   lowBalanceThresholdPercent?: int|null,
 *   maxRolloverCount?: int|null,
 *   overageLimit?: string|null,
 *   pricePerUnit?: string|null,
 *   rolloverPercentage?: int|null,
 *   rolloverTimeframeCount?: int|null,
 *   rolloverTimeframeInterval?: null|TimeInterval|value-of<TimeInterval>,
 *   trialCredits?: string|null,
 * }
 */
final class CreditEntitlementMappingResponse implements BaseModel
{
    /** @use SdkModel<CreditEntitlementMappingResponseShape> */
    use SdkModel;

    /**
     * Unique ID of this mapping.
     */
    #[Required]
    public string $id;

    /**
     * ID of the credit entitlement.
     */
    #[Required('credit_entitlement_id')]
    public string $creditEntitlementID;

    /**
     * Name of the credit entitlement.
     */
    #[Required('credit_entitlement_name')]
    public string $creditEntitlementName;

    /**
     * Unit label for the credit entitlement.
     */
    #[Required('credit_entitlement_unit')]
    public string $creditEntitlementUnit;

    /**
     * Number of credits granted.
     */
    #[Required('credits_amount')]
    public string $creditsAmount;

    /**
     * Controls how overage is handled at billing cycle end.
     *
     * @var value-of<CbbOverageBehavior> $overageBehavior
     */
    #[Required('overage_behavior', enum: CbbOverageBehavior::class)]
    public string $overageBehavior;

    /**
     * Whether overage is enabled.
     */
    #[Required('overage_enabled')]
    public bool $overageEnabled;

    /**
     * Proration behavior for credit grants during plan changes.
     *
     * @var value-of<CbbProrationBehavior> $prorationBehavior
     */
    #[Required('proration_behavior', enum: CbbProrationBehavior::class)]
    public string $prorationBehavior;

    /**
     * Whether rollover is enabled.
     */
    #[Required('rollover_enabled')]
    public bool $rolloverEnabled;

    /**
     * Whether trial credits expire after trial.
     */
    #[Required('trial_credits_expire_after_trial')]
    public bool $trialCreditsExpireAfterTrial;

    /**
     * Currency.
     *
     * @var value-of<Currency>|null $currency
     */
    #[Optional(enum: Currency::class, nullable: true)]
    public ?string $currency;

    /**
     * Days until credits expire.
     */
    #[Optional('expires_after_days', nullable: true)]
    public ?int $expiresAfterDays;

    /**
     * Low balance threshold percentage.
     */
    #[Optional('low_balance_threshold_percent', nullable: true)]
    public ?int $lowBalanceThresholdPercent;

    /**
     * Maximum rollover cycles.
     */
    #[Optional('max_rollover_count', nullable: true)]
    public ?int $maxRolloverCount;

    /**
     * Overage limit.
     */
    #[Optional('overage_limit', nullable: true)]
    public ?string $overageLimit;

    /**
     * Price per unit.
     */
    #[Optional('price_per_unit', nullable: true)]
    public ?string $pricePerUnit;

    /**
     * Rollover percentage.
     */
    #[Optional('rollover_percentage', nullable: true)]
    public ?int $rolloverPercentage;

    /**
     * Rollover timeframe count.
     */
    #[Optional('rollover_timeframe_count', nullable: true)]
    public ?int $rolloverTimeframeCount;

    /**
     * Rollover timeframe interval.
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
     * Trial credits.
     */
    #[Optional('trial_credits', nullable: true)]
    public ?string $trialCredits;

    /**
     * `new CreditEntitlementMappingResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditEntitlementMappingResponse::with(
     *   id: ...,
     *   creditEntitlementID: ...,
     *   creditEntitlementName: ...,
     *   creditEntitlementUnit: ...,
     *   creditsAmount: ...,
     *   overageBehavior: ...,
     *   overageEnabled: ...,
     *   prorationBehavior: ...,
     *   rolloverEnabled: ...,
     *   trialCreditsExpireAfterTrial: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditEntitlementMappingResponse)
     *   ->withID(...)
     *   ->withCreditEntitlementID(...)
     *   ->withCreditEntitlementName(...)
     *   ->withCreditEntitlementUnit(...)
     *   ->withCreditsAmount(...)
     *   ->withOverageBehavior(...)
     *   ->withOverageEnabled(...)
     *   ->withProrationBehavior(...)
     *   ->withRolloverEnabled(...)
     *   ->withTrialCreditsExpireAfterTrial(...)
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
     * @param CbbOverageBehavior|value-of<CbbOverageBehavior> $overageBehavior
     * @param CbbProrationBehavior|value-of<CbbProrationBehavior> $prorationBehavior
     * @param Currency|value-of<Currency>|null $currency
     * @param TimeInterval|value-of<TimeInterval>|null $rolloverTimeframeInterval
     */
    public static function with(
        string $id,
        string $creditEntitlementID,
        string $creditEntitlementName,
        string $creditEntitlementUnit,
        string $creditsAmount,
        CbbOverageBehavior|string $overageBehavior,
        bool $overageEnabled,
        CbbProrationBehavior|string $prorationBehavior,
        bool $rolloverEnabled,
        bool $trialCreditsExpireAfterTrial,
        Currency|string|null $currency = null,
        ?int $expiresAfterDays = null,
        ?int $lowBalanceThresholdPercent = null,
        ?int $maxRolloverCount = null,
        ?string $overageLimit = null,
        ?string $pricePerUnit = null,
        ?int $rolloverPercentage = null,
        ?int $rolloverTimeframeCount = null,
        TimeInterval|string|null $rolloverTimeframeInterval = null,
        ?string $trialCredits = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['creditEntitlementID'] = $creditEntitlementID;
        $self['creditEntitlementName'] = $creditEntitlementName;
        $self['creditEntitlementUnit'] = $creditEntitlementUnit;
        $self['creditsAmount'] = $creditsAmount;
        $self['overageBehavior'] = $overageBehavior;
        $self['overageEnabled'] = $overageEnabled;
        $self['prorationBehavior'] = $prorationBehavior;
        $self['rolloverEnabled'] = $rolloverEnabled;
        $self['trialCreditsExpireAfterTrial'] = $trialCreditsExpireAfterTrial;

        null !== $currency && $self['currency'] = $currency;
        null !== $expiresAfterDays && $self['expiresAfterDays'] = $expiresAfterDays;
        null !== $lowBalanceThresholdPercent && $self['lowBalanceThresholdPercent'] = $lowBalanceThresholdPercent;
        null !== $maxRolloverCount && $self['maxRolloverCount'] = $maxRolloverCount;
        null !== $overageLimit && $self['overageLimit'] = $overageLimit;
        null !== $pricePerUnit && $self['pricePerUnit'] = $pricePerUnit;
        null !== $rolloverPercentage && $self['rolloverPercentage'] = $rolloverPercentage;
        null !== $rolloverTimeframeCount && $self['rolloverTimeframeCount'] = $rolloverTimeframeCount;
        null !== $rolloverTimeframeInterval && $self['rolloverTimeframeInterval'] = $rolloverTimeframeInterval;
        null !== $trialCredits && $self['trialCredits'] = $trialCredits;

        return $self;
    }

    /**
     * Unique ID of this mapping.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * ID of the credit entitlement.
     */
    public function withCreditEntitlementID(string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }

    /**
     * Name of the credit entitlement.
     */
    public function withCreditEntitlementName(
        string $creditEntitlementName
    ): self {
        $self = clone $this;
        $self['creditEntitlementName'] = $creditEntitlementName;

        return $self;
    }

    /**
     * Unit label for the credit entitlement.
     */
    public function withCreditEntitlementUnit(
        string $creditEntitlementUnit
    ): self {
        $self = clone $this;
        $self['creditEntitlementUnit'] = $creditEntitlementUnit;

        return $self;
    }

    /**
     * Number of credits granted.
     */
    public function withCreditsAmount(string $creditsAmount): self
    {
        $self = clone $this;
        $self['creditsAmount'] = $creditsAmount;

        return $self;
    }

    /**
     * Controls how overage is handled at billing cycle end.
     *
     * @param CbbOverageBehavior|value-of<CbbOverageBehavior> $overageBehavior
     */
    public function withOverageBehavior(
        CbbOverageBehavior|string $overageBehavior
    ): self {
        $self = clone $this;
        $self['overageBehavior'] = $overageBehavior;

        return $self;
    }

    /**
     * Whether overage is enabled.
     */
    public function withOverageEnabled(bool $overageEnabled): self
    {
        $self = clone $this;
        $self['overageEnabled'] = $overageEnabled;

        return $self;
    }

    /**
     * Proration behavior for credit grants during plan changes.
     *
     * @param CbbProrationBehavior|value-of<CbbProrationBehavior> $prorationBehavior
     */
    public function withProrationBehavior(
        CbbProrationBehavior|string $prorationBehavior
    ): self {
        $self = clone $this;
        $self['prorationBehavior'] = $prorationBehavior;

        return $self;
    }

    /**
     * Whether rollover is enabled.
     */
    public function withRolloverEnabled(bool $rolloverEnabled): self
    {
        $self = clone $this;
        $self['rolloverEnabled'] = $rolloverEnabled;

        return $self;
    }

    /**
     * Whether trial credits expire after trial.
     */
    public function withTrialCreditsExpireAfterTrial(
        bool $trialCreditsExpireAfterTrial
    ): self {
        $self = clone $this;
        $self['trialCreditsExpireAfterTrial'] = $trialCreditsExpireAfterTrial;

        return $self;
    }

    /**
     * Currency.
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
     * Days until credits expire.
     */
    public function withExpiresAfterDays(?int $expiresAfterDays): self
    {
        $self = clone $this;
        $self['expiresAfterDays'] = $expiresAfterDays;

        return $self;
    }

    /**
     * Low balance threshold percentage.
     */
    public function withLowBalanceThresholdPercent(
        ?int $lowBalanceThresholdPercent
    ): self {
        $self = clone $this;
        $self['lowBalanceThresholdPercent'] = $lowBalanceThresholdPercent;

        return $self;
    }

    /**
     * Maximum rollover cycles.
     */
    public function withMaxRolloverCount(?int $maxRolloverCount): self
    {
        $self = clone $this;
        $self['maxRolloverCount'] = $maxRolloverCount;

        return $self;
    }

    /**
     * Overage limit.
     */
    public function withOverageLimit(?string $overageLimit): self
    {
        $self = clone $this;
        $self['overageLimit'] = $overageLimit;

        return $self;
    }

    /**
     * Price per unit.
     */
    public function withPricePerUnit(?string $pricePerUnit): self
    {
        $self = clone $this;
        $self['pricePerUnit'] = $pricePerUnit;

        return $self;
    }

    /**
     * Rollover percentage.
     */
    public function withRolloverPercentage(?int $rolloverPercentage): self
    {
        $self = clone $this;
        $self['rolloverPercentage'] = $rolloverPercentage;

        return $self;
    }

    /**
     * Rollover timeframe count.
     */
    public function withRolloverTimeframeCount(
        ?int $rolloverTimeframeCount
    ): self {
        $self = clone $this;
        $self['rolloverTimeframeCount'] = $rolloverTimeframeCount;

        return $self;
    }

    /**
     * Rollover timeframe interval.
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
     * Trial credits.
     */
    public function withTrialCredits(?string $trialCredits): self
    {
        $self = clone $this;
        $self['trialCredits'] = $trialCredits;

        return $self;
    }
}
