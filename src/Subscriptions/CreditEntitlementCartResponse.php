<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\CreditEntitlements\CbbOverageBehavior;

/**
 * Response struct representing credit entitlement cart details for a subscription.
 *
 * @phpstan-type CreditEntitlementCartResponseShape = array{
 *   creditEntitlementID: string,
 *   creditEntitlementName: string,
 *   creditsAmount: string,
 *   overageBalance: string,
 *   overageBehavior: CbbOverageBehavior|value-of<CbbOverageBehavior>,
 *   overageEnabled: bool,
 *   productID: string,
 *   remainingBalance: string,
 *   rolloverEnabled: bool,
 *   unit: string,
 *   expiresAfterDays?: int|null,
 *   lowBalanceThresholdPercent?: int|null,
 *   maxRolloverCount?: int|null,
 *   overageLimit?: string|null,
 *   rolloverPercentage?: int|null,
 *   rolloverTimeframeCount?: int|null,
 *   rolloverTimeframeInterval?: null|TimeInterval|value-of<TimeInterval>,
 * }
 */
final class CreditEntitlementCartResponse implements BaseModel
{
    /** @use SdkModel<CreditEntitlementCartResponseShape> */
    use SdkModel;

    #[Required('credit_entitlement_id')]
    public string $creditEntitlementID;

    #[Required('credit_entitlement_name')]
    public string $creditEntitlementName;

    #[Required('credits_amount')]
    public string $creditsAmount;

    /**
     * Customer's current overage balance for this entitlement.
     */
    #[Required('overage_balance')]
    public string $overageBalance;

    /**
     * Controls how overage is handled at the end of a billing cycle.
     *
     * | Preset                  | Charge at billing | Credits reduce overage | Preserve overage at reset |
     * |-------------------------|:-----------------:|:---------------------:|:-------------------------:|
     * | `forgive_at_reset`      | No                | No                    | No                        |
     * | `invoice_at_billing`    | Yes               | No                    | No                        |
     * | `carry_deficit`         | No                | No                    | Yes                       |
     * | `carry_deficit_auto_repay` | No             | Yes                   | Yes                       |
     *
     * @var value-of<CbbOverageBehavior> $overageBehavior
     */
    #[Required('overage_behavior', enum: CbbOverageBehavior::class)]
    public string $overageBehavior;

    #[Required('overage_enabled')]
    public bool $overageEnabled;

    #[Required('product_id')]
    public string $productID;

    /**
     * Customer's current remaining credit balance for this entitlement.
     */
    #[Required('remaining_balance')]
    public string $remainingBalance;

    #[Required('rollover_enabled')]
    public bool $rolloverEnabled;

    /**
     * Unit label for the credit entitlement (e.g., "API Calls", "Tokens").
     */
    #[Required]
    public string $unit;

    #[Optional('expires_after_days', nullable: true)]
    public ?int $expiresAfterDays;

    #[Optional('low_balance_threshold_percent', nullable: true)]
    public ?int $lowBalanceThresholdPercent;

    #[Optional('max_rollover_count', nullable: true)]
    public ?int $maxRolloverCount;

    #[Optional('overage_limit', nullable: true)]
    public ?string $overageLimit;

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
     * `new CreditEntitlementCartResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditEntitlementCartResponse::with(
     *   creditEntitlementID: ...,
     *   creditEntitlementName: ...,
     *   creditsAmount: ...,
     *   overageBalance: ...,
     *   overageBehavior: ...,
     *   overageEnabled: ...,
     *   productID: ...,
     *   remainingBalance: ...,
     *   rolloverEnabled: ...,
     *   unit: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditEntitlementCartResponse)
     *   ->withCreditEntitlementID(...)
     *   ->withCreditEntitlementName(...)
     *   ->withCreditsAmount(...)
     *   ->withOverageBalance(...)
     *   ->withOverageBehavior(...)
     *   ->withOverageEnabled(...)
     *   ->withProductID(...)
     *   ->withRemainingBalance(...)
     *   ->withRolloverEnabled(...)
     *   ->withUnit(...)
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
     * @param TimeInterval|value-of<TimeInterval>|null $rolloverTimeframeInterval
     */
    public static function with(
        string $creditEntitlementID,
        string $creditEntitlementName,
        string $creditsAmount,
        string $overageBalance,
        CbbOverageBehavior|string $overageBehavior,
        bool $overageEnabled,
        string $productID,
        string $remainingBalance,
        bool $rolloverEnabled,
        string $unit,
        ?int $expiresAfterDays = null,
        ?int $lowBalanceThresholdPercent = null,
        ?int $maxRolloverCount = null,
        ?string $overageLimit = null,
        ?int $rolloverPercentage = null,
        ?int $rolloverTimeframeCount = null,
        TimeInterval|string|null $rolloverTimeframeInterval = null,
    ): self {
        $self = new self;

        $self['creditEntitlementID'] = $creditEntitlementID;
        $self['creditEntitlementName'] = $creditEntitlementName;
        $self['creditsAmount'] = $creditsAmount;
        $self['overageBalance'] = $overageBalance;
        $self['overageBehavior'] = $overageBehavior;
        $self['overageEnabled'] = $overageEnabled;
        $self['productID'] = $productID;
        $self['remainingBalance'] = $remainingBalance;
        $self['rolloverEnabled'] = $rolloverEnabled;
        $self['unit'] = $unit;

        null !== $expiresAfterDays && $self['expiresAfterDays'] = $expiresAfterDays;
        null !== $lowBalanceThresholdPercent && $self['lowBalanceThresholdPercent'] = $lowBalanceThresholdPercent;
        null !== $maxRolloverCount && $self['maxRolloverCount'] = $maxRolloverCount;
        null !== $overageLimit && $self['overageLimit'] = $overageLimit;
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

    public function withCreditEntitlementName(
        string $creditEntitlementName
    ): self {
        $self = clone $this;
        $self['creditEntitlementName'] = $creditEntitlementName;

        return $self;
    }

    public function withCreditsAmount(string $creditsAmount): self
    {
        $self = clone $this;
        $self['creditsAmount'] = $creditsAmount;

        return $self;
    }

    /**
     * Customer's current overage balance for this entitlement.
     */
    public function withOverageBalance(string $overageBalance): self
    {
        $self = clone $this;
        $self['overageBalance'] = $overageBalance;

        return $self;
    }

    /**
     * Controls how overage is handled at the end of a billing cycle.
     *
     * | Preset                  | Charge at billing | Credits reduce overage | Preserve overage at reset |
     * |-------------------------|:-----------------:|:---------------------:|:-------------------------:|
     * | `forgive_at_reset`      | No                | No                    | No                        |
     * | `invoice_at_billing`    | Yes               | No                    | No                        |
     * | `carry_deficit`         | No                | No                    | Yes                       |
     * | `carry_deficit_auto_repay` | No             | Yes                   | Yes                       |
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

    public function withOverageEnabled(bool $overageEnabled): self
    {
        $self = clone $this;
        $self['overageEnabled'] = $overageEnabled;

        return $self;
    }

    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * Customer's current remaining credit balance for this entitlement.
     */
    public function withRemainingBalance(string $remainingBalance): self
    {
        $self = clone $this;
        $self['remainingBalance'] = $remainingBalance;

        return $self;
    }

    public function withRolloverEnabled(bool $rolloverEnabled): self
    {
        $self = clone $this;
        $self['rolloverEnabled'] = $rolloverEnabled;

        return $self;
    }

    /**
     * Unit label for the credit entitlement (e.g., "API Calls", "Tokens").
     */
    public function withUnit(string $unit): self
    {
        $self = clone $this;
        $self['unit'] = $unit;

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

    public function withOverageLimit(?string $overageLimit): self
    {
        $self = clone $this;
        $self['overageLimit'] = $overageLimit;

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
