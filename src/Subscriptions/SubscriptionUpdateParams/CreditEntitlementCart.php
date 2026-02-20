<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionUpdateParams;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * @phpstan-type CreditEntitlementCartShape = array{
 *   creditEntitlementID: string,
 *   creditsAmount?: string|null,
 *   expiresAfterDays?: int|null,
 *   lowBalanceThresholdPercent?: int|null,
 *   maxRolloverCount?: int|null,
 *   overageChargeAtBilling?: bool|null,
 *   overageEnabled?: bool|null,
 *   overageLimit?: string|null,
 *   rolloverEnabled?: bool|null,
 *   rolloverPercentage?: int|null,
 *   rolloverTimeframeCount?: int|null,
 *   rolloverTimeframeInterval?: null|TimeInterval|value-of<TimeInterval>,
 * }
 */
final class CreditEntitlementCart implements BaseModel
{
    /** @use SdkModel<CreditEntitlementCartShape> */
    use SdkModel;

    #[Required('credit_entitlement_id')]
    public string $creditEntitlementID;

    #[Optional('credits_amount', nullable: true)]
    public ?string $creditsAmount;

    #[Optional('expires_after_days', nullable: true)]
    public ?int $expiresAfterDays;

    #[Optional('low_balance_threshold_percent', nullable: true)]
    public ?int $lowBalanceThresholdPercent;

    #[Optional('max_rollover_count', nullable: true)]
    public ?int $maxRolloverCount;

    #[Optional('overage_charge_at_billing', nullable: true)]
    public ?bool $overageChargeAtBilling;

    #[Optional('overage_enabled', nullable: true)]
    public ?bool $overageEnabled;

    #[Optional('overage_limit', nullable: true)]
    public ?string $overageLimit;

    #[Optional('rollover_enabled', nullable: true)]
    public ?bool $rolloverEnabled;

    #[Optional('rollover_percentage', nullable: true)]
    public ?int $rolloverPercentage;

    #[Optional('rollover_timeframe_count', nullable: true)]
    public ?int $rolloverTimeframeCount;

    /** @var value-of<TimeInterval>|null $rolloverTimeframeInterval */
    #[Optional(
        'rollover_timeframe_interval',
        enum: TimeInterval::class,
        nullable: true
    )]
    public ?string $rolloverTimeframeInterval;

    /**
     * `new CreditEntitlementCart()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditEntitlementCart::with(creditEntitlementID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditEntitlementCart)->withCreditEntitlementID(...)
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
     * @param TimeInterval|value-of<TimeInterval>|null $rolloverTimeframeInterval
     */
    public static function with(
        string $creditEntitlementID,
        ?string $creditsAmount = null,
        ?int $expiresAfterDays = null,
        ?int $lowBalanceThresholdPercent = null,
        ?int $maxRolloverCount = null,
        ?bool $overageChargeAtBilling = null,
        ?bool $overageEnabled = null,
        ?string $overageLimit = null,
        ?bool $rolloverEnabled = null,
        ?int $rolloverPercentage = null,
        ?int $rolloverTimeframeCount = null,
        TimeInterval|string|null $rolloverTimeframeInterval = null,
    ): self {
        $self = new self;

        $self['creditEntitlementID'] = $creditEntitlementID;

        null !== $creditsAmount && $self['creditsAmount'] = $creditsAmount;
        null !== $expiresAfterDays && $self['expiresAfterDays'] = $expiresAfterDays;
        null !== $lowBalanceThresholdPercent && $self['lowBalanceThresholdPercent'] = $lowBalanceThresholdPercent;
        null !== $maxRolloverCount && $self['maxRolloverCount'] = $maxRolloverCount;
        null !== $overageChargeAtBilling && $self['overageChargeAtBilling'] = $overageChargeAtBilling;
        null !== $overageEnabled && $self['overageEnabled'] = $overageEnabled;
        null !== $overageLimit && $self['overageLimit'] = $overageLimit;
        null !== $rolloverEnabled && $self['rolloverEnabled'] = $rolloverEnabled;
        null !== $rolloverPercentage && $self['rolloverPercentage'] = $rolloverPercentage;
        null !== $rolloverTimeframeCount && $self['rolloverTimeframeCount'] = $rolloverTimeframeCount;
        null !== $rolloverTimeframeInterval && $self['rolloverTimeframeInterval'] = $rolloverTimeframeInterval;

        return $self;
    }

    public function withCreditEntitlementID(string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }

    public function withCreditsAmount(?string $creditsAmount): self
    {
        $self = clone $this;
        $self['creditsAmount'] = $creditsAmount;

        return $self;
    }

    public function withExpiresAfterDays(?int $expiresAfterDays): self
    {
        $self = clone $this;
        $self['expiresAfterDays'] = $expiresAfterDays;

        return $self;
    }

    public function withLowBalanceThresholdPercent(
        ?int $lowBalanceThresholdPercent
    ): self {
        $self = clone $this;
        $self['lowBalanceThresholdPercent'] = $lowBalanceThresholdPercent;

        return $self;
    }

    public function withMaxRolloverCount(?int $maxRolloverCount): self
    {
        $self = clone $this;
        $self['maxRolloverCount'] = $maxRolloverCount;

        return $self;
    }

    public function withOverageChargeAtBilling(
        ?bool $overageChargeAtBilling
    ): self {
        $self = clone $this;
        $self['overageChargeAtBilling'] = $overageChargeAtBilling;

        return $self;
    }

    public function withOverageEnabled(?bool $overageEnabled): self
    {
        $self = clone $this;
        $self['overageEnabled'] = $overageEnabled;

        return $self;
    }

    public function withOverageLimit(?string $overageLimit): self
    {
        $self = clone $this;
        $self['overageLimit'] = $overageLimit;

        return $self;
    }

    public function withRolloverEnabled(?bool $rolloverEnabled): self
    {
        $self = clone $this;
        $self['rolloverEnabled'] = $rolloverEnabled;

        return $self;
    }

    public function withRolloverPercentage(?int $rolloverPercentage): self
    {
        $self = clone $this;
        $self['rolloverPercentage'] = $rolloverPercentage;

        return $self;
    }

    public function withRolloverTimeframeCount(
        ?int $rolloverTimeframeCount
    ): self {
        $self = clone $this;
        $self['rolloverTimeframeCount'] = $rolloverTimeframeCount;

        return $self;
    }

    /**
     * @param TimeInterval|value-of<TimeInterval>|null $rolloverTimeframeInterval
     */
    public function withRolloverTimeframeInterval(
        TimeInterval|string|null $rolloverTimeframeInterval
    ): self {
        $self = clone $this;
        $self['rolloverTimeframeInterval'] = $rolloverTimeframeInterval;

        return $self;
    }
}
