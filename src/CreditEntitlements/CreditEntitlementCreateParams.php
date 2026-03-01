<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * Credit entitlements define reusable credit templates that can be attached to products.
 * Each entitlement defines how credits behave in terms of expiration, rollover, and overage.
 *
 * # Authentication
 * Requires an API key with `Editor` role.
 *
 * # Request Body
 * - `name` - Human-readable name of the credit entitlement (1-255 characters, required)
 * - `description` - Optional description (max 1000 characters)
 * - `precision` - Decimal precision for credit amounts (0-10 decimal places)
 * - `unit` - Unit of measurement for the credit (e.g., "API Calls", "Tokens", "Credits")
 * - `expires_after_days` - Number of days after which credits expire (optional)
 * - `rollover_enabled` - Whether unused credits can rollover to the next period
 * - `rollover_percentage` - Percentage of unused credits that rollover (0-100)
 * - `rollover_timeframe_count` - Count of timeframe periods for rollover limit
 * - `rollover_timeframe_interval` - Interval type (day, week, month, year)
 * - `max_rollover_count` - Maximum number of times credits can be rolled over
 * - `overage_enabled` - Whether overage charges apply when credits run out (requires price_per_unit)
 * - `overage_limit` - Maximum overage units allowed (optional)
 * - `currency` - Currency for pricing (required if price_per_unit is set)
 * - `price_per_unit` - Price per credit unit (decimal)
 *
 * # Responses
 * - `201 Created` - Credit entitlement created successfully, returns the full entitlement object
 * - `422 Unprocessable Entity` - Invalid request parameters or validation failure
 * - `500 Internal Server Error` - Database or server error
 *
 * # Business Logic
 * - A unique ID with prefix `cde_` is automatically generated for the entitlement
 * - Created and updated timestamps are automatically set
 * - Currency is required when price_per_unit is set
 * - price_per_unit is required when overage_enabled is true
 * - rollover_timeframe_count and rollover_timeframe_interval must both be set or both be null
 *
 * @see Dodopayments\Services\CreditEntitlementsService::create()
 *
 * @phpstan-type CreditEntitlementCreateParamsShape = array{
 *   name: string,
 *   overageEnabled: bool,
 *   precision: int,
 *   rolloverEnabled: bool,
 *   unit: string,
 *   currency?: null|Currency|value-of<Currency>,
 *   description?: string|null,
 *   expiresAfterDays?: int|null,
 *   maxRolloverCount?: int|null,
 *   overageBehavior?: null|CbbOverageBehavior|value-of<CbbOverageBehavior>,
 *   overageLimit?: int|null,
 *   pricePerUnit?: string|null,
 *   rolloverPercentage?: int|null,
 *   rolloverTimeframeCount?: int|null,
 *   rolloverTimeframeInterval?: null|TimeInterval|value-of<TimeInterval>,
 * }
 */
final class CreditEntitlementCreateParams implements BaseModel
{
    /** @use SdkModel<CreditEntitlementCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Name of the credit entitlement.
     */
    #[Required]
    public string $name;

    /**
     * Whether overage charges are enabled when credits run out.
     */
    #[Required('overage_enabled')]
    public bool $overageEnabled;

    /**
     * Precision for credit amounts (0-10 decimal places).
     */
    #[Required]
    public int $precision;

    /**
     * Whether rollover is enabled for unused credits.
     */
    #[Required('rollover_enabled')]
    public bool $rolloverEnabled;

    /**
     * Unit of measurement for the credit (e.g., "API Calls", "Tokens", "Credits").
     */
    #[Required]
    public string $unit;

    /**
     * Currency for pricing (required if price_per_unit is set).
     *
     * @var value-of<Currency>|null $currency
     */
    #[Optional(enum: Currency::class, nullable: true)]
    public ?string $currency;

    /**
     * Optional description of the credit entitlement.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Number of days after which credits expire (optional).
     */
    #[Optional('expires_after_days', nullable: true)]
    public ?int $expiresAfterDays;

    /**
     * Maximum number of times credits can be rolled over.
     */
    #[Optional('max_rollover_count', nullable: true)]
    public ?int $maxRolloverCount;

    /**
     * Controls how overage is handled at billing cycle end.
     * Defaults to forgive_at_reset if not specified.
     *
     * @var value-of<CbbOverageBehavior>|null $overageBehavior
     */
    #[Optional(
        'overage_behavior',
        enum: CbbOverageBehavior::class,
        nullable: true
    )]
    public ?string $overageBehavior;

    /**
     * Maximum overage units allowed (optional).
     */
    #[Optional('overage_limit', nullable: true)]
    public ?int $overageLimit;

    /**
     * Price per credit unit.
     */
    #[Optional('price_per_unit', nullable: true)]
    public ?string $pricePerUnit;

    /**
     * Percentage of unused credits that can rollover (0-100).
     */
    #[Optional('rollover_percentage', nullable: true)]
    public ?int $rolloverPercentage;

    /**
     * Count of timeframe periods for rollover limit.
     */
    #[Optional('rollover_timeframe_count', nullable: true)]
    public ?int $rolloverTimeframeCount;

    /**
     * Interval type for rollover timeframe.
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
     * `new CreditEntitlementCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditEntitlementCreateParams::with(
     *   name: ...,
     *   overageEnabled: ...,
     *   precision: ...,
     *   rolloverEnabled: ...,
     *   unit: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditEntitlementCreateParams)
     *   ->withName(...)
     *   ->withOverageEnabled(...)
     *   ->withPrecision(...)
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
     * @param Currency|value-of<Currency>|null $currency
     * @param CbbOverageBehavior|value-of<CbbOverageBehavior>|null $overageBehavior
     * @param TimeInterval|value-of<TimeInterval>|null $rolloverTimeframeInterval
     */
    public static function with(
        string $name,
        bool $overageEnabled,
        int $precision,
        bool $rolloverEnabled,
        string $unit,
        Currency|string|null $currency = null,
        ?string $description = null,
        ?int $expiresAfterDays = null,
        ?int $maxRolloverCount = null,
        CbbOverageBehavior|string|null $overageBehavior = null,
        ?int $overageLimit = null,
        ?string $pricePerUnit = null,
        ?int $rolloverPercentage = null,
        ?int $rolloverTimeframeCount = null,
        TimeInterval|string|null $rolloverTimeframeInterval = null,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['overageEnabled'] = $overageEnabled;
        $self['precision'] = $precision;
        $self['rolloverEnabled'] = $rolloverEnabled;
        $self['unit'] = $unit;

        null !== $currency && $self['currency'] = $currency;
        null !== $description && $self['description'] = $description;
        null !== $expiresAfterDays && $self['expiresAfterDays'] = $expiresAfterDays;
        null !== $maxRolloverCount && $self['maxRolloverCount'] = $maxRolloverCount;
        null !== $overageBehavior && $self['overageBehavior'] = $overageBehavior;
        null !== $overageLimit && $self['overageLimit'] = $overageLimit;
        null !== $pricePerUnit && $self['pricePerUnit'] = $pricePerUnit;
        null !== $rolloverPercentage && $self['rolloverPercentage'] = $rolloverPercentage;
        null !== $rolloverTimeframeCount && $self['rolloverTimeframeCount'] = $rolloverTimeframeCount;
        null !== $rolloverTimeframeInterval && $self['rolloverTimeframeInterval'] = $rolloverTimeframeInterval;

        return $self;
    }

    /**
     * Name of the credit entitlement.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Whether overage charges are enabled when credits run out.
     */
    public function withOverageEnabled(bool $overageEnabled): self
    {
        $self = clone $this;
        $self['overageEnabled'] = $overageEnabled;

        return $self;
    }

    /**
     * Precision for credit amounts (0-10 decimal places).
     */
    public function withPrecision(int $precision): self
    {
        $self = clone $this;
        $self['precision'] = $precision;

        return $self;
    }

    /**
     * Whether rollover is enabled for unused credits.
     */
    public function withRolloverEnabled(bool $rolloverEnabled): self
    {
        $self = clone $this;
        $self['rolloverEnabled'] = $rolloverEnabled;

        return $self;
    }

    /**
     * Unit of measurement for the credit (e.g., "API Calls", "Tokens", "Credits").
     */
    public function withUnit(string $unit): self
    {
        $self = clone $this;
        $self['unit'] = $unit;

        return $self;
    }

    /**
     * Currency for pricing (required if price_per_unit is set).
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
     * Optional description of the credit entitlement.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Number of days after which credits expire (optional).
     */
    public function withExpiresAfterDays(?int $expiresAfterDays): self
    {
        $self = clone $this;
        $self['expiresAfterDays'] = $expiresAfterDays;

        return $self;
    }

    /**
     * Maximum number of times credits can be rolled over.
     */
    public function withMaxRolloverCount(?int $maxRolloverCount): self
    {
        $self = clone $this;
        $self['maxRolloverCount'] = $maxRolloverCount;

        return $self;
    }

    /**
     * Controls how overage is handled at billing cycle end.
     * Defaults to forgive_at_reset if not specified.
     *
     * @param CbbOverageBehavior|value-of<CbbOverageBehavior>|null $overageBehavior
     */
    public function withOverageBehavior(
        CbbOverageBehavior|string|null $overageBehavior
    ): self {
        $self = clone $this;
        $self['overageBehavior'] = $overageBehavior;

        return $self;
    }

    /**
     * Maximum overage units allowed (optional).
     */
    public function withOverageLimit(?int $overageLimit): self
    {
        $self = clone $this;
        $self['overageLimit'] = $overageLimit;

        return $self;
    }

    /**
     * Price per credit unit.
     */
    public function withPricePerUnit(?string $pricePerUnit): self
    {
        $self = clone $this;
        $self['pricePerUnit'] = $pricePerUnit;

        return $self;
    }

    /**
     * Percentage of unused credits that can rollover (0-100).
     */
    public function withRolloverPercentage(?int $rolloverPercentage): self
    {
        $self = clone $this;
        $self['rolloverPercentage'] = $rolloverPercentage;

        return $self;
    }

    /**
     * Count of timeframe periods for rollover limit.
     */
    public function withRolloverTimeframeCount(
        ?int $rolloverTimeframeCount
    ): self {
        $self = clone $this;
        $self['rolloverTimeframeCount'] = $rolloverTimeframeCount;

        return $self;
    }

    /**
     * Interval type for rollover timeframe.
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
}
