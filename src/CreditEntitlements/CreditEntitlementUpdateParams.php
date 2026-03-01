<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * Allows partial updates to a credit entitlement's configuration. Only the fields
 * provided in the request body will be updated; all other fields remain unchanged.
 * This endpoint supports nullable fields using the double option pattern.
 *
 * # Authentication
 * Requires an API key with `Editor` role.
 *
 * # Path Parameters
 * - `id` - The unique identifier of the credit entitlement to update (format: `cde_...`)
 *
 * # Request Body (all fields optional)
 * - `name` - Human-readable name of the credit entitlement (1-255 characters)
 * - `description` - Optional description (max 1000 characters)
 * - `unit` - Unit of measurement for the credit (1-50 characters)
 *
 * Note: `precision` cannot be modified after creation as it would invalidate existing grants.
 * - `expires_after_days` - Number of days after which credits expire (use `null` to remove expiration)
 * - `rollover_enabled` - Whether unused credits can rollover to the next period
 * - `rollover_percentage` - Percentage of unused credits that rollover (0-100, nullable)
 * - `rollover_timeframe_count` - Count of timeframe periods for rollover limit (nullable)
 * - `rollover_timeframe_interval` - Interval type (day, week, month, year, nullable)
 * - `max_rollover_count` - Maximum number of times credits can be rolled over (nullable)
 * - `overage_enabled` - Whether overage charges apply when credits run out
 * - `overage_limit` - Maximum overage units allowed (nullable)
 * - `currency` - Currency for pricing (nullable)
 * - `price_per_unit` - Price per credit unit (decimal, nullable)
 *
 * # Responses
 * - `200 OK` - Credit entitlement updated successfully
 * - `404 Not Found` - Credit entitlement does not exist or does not belong to the authenticated business
 * - `422 Unprocessable Entity` - Invalid request parameters or validation failure
 * - `500 Internal Server Error` - Database or server error
 *
 * # Business Logic
 * - Only non-deleted credit entitlements can be updated
 * - Fields set to `null` explicitly will clear the database value (using double option pattern)
 * - The `updated_at` timestamp is automatically updated on successful modification
 * - Changes take effect immediately but do not retroactively affect existing credit grants
 * - The merged state is validated: currency required with price, rollover timeframe fields together, price required for overage
 *
 * @see Dodopayments\Services\CreditEntitlementsService::update()
 *
 * @phpstan-type CreditEntitlementUpdateParamsShape = array{
 *   currency?: null|Currency|value-of<Currency>,
 *   description?: string|null,
 *   expiresAfterDays?: int|null,
 *   maxRolloverCount?: int|null,
 *   name?: string|null,
 *   overageBehavior?: null|CbbOverageBehavior|value-of<CbbOverageBehavior>,
 *   overageEnabled?: bool|null,
 *   overageLimit?: int|null,
 *   pricePerUnit?: string|null,
 *   rolloverEnabled?: bool|null,
 *   rolloverPercentage?: int|null,
 *   rolloverTimeframeCount?: int|null,
 *   rolloverTimeframeInterval?: null|TimeInterval|value-of<TimeInterval>,
 *   unit?: string|null,
 * }
 */
final class CreditEntitlementUpdateParams implements BaseModel
{
    /** @use SdkModel<CreditEntitlementUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Currency for pricing.
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
     * Number of days after which credits expire.
     */
    #[Optional('expires_after_days', nullable: true)]
    public ?int $expiresAfterDays;

    /**
     * Maximum number of times credits can be rolled over.
     */
    #[Optional('max_rollover_count', nullable: true)]
    public ?int $maxRolloverCount;

    /**
     * Name of the credit entitlement.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * Controls how overage is handled at billing cycle end.
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
     * Whether overage charges are enabled when credits run out.
     */
    #[Optional('overage_enabled', nullable: true)]
    public ?bool $overageEnabled;

    /**
     * Maximum overage units allowed.
     */
    #[Optional('overage_limit', nullable: true)]
    public ?int $overageLimit;

    /**
     * Price per credit unit.
     */
    #[Optional('price_per_unit', nullable: true)]
    public ?string $pricePerUnit;

    /**
     * Whether rollover is enabled for unused credits.
     */
    #[Optional('rollover_enabled', nullable: true)]
    public ?bool $rolloverEnabled;

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
     * Unit of measurement for the credit (e.g., "API Calls", "Tokens", "Credits").
     */
    #[Optional(nullable: true)]
    public ?string $unit;

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
        Currency|string|null $currency = null,
        ?string $description = null,
        ?int $expiresAfterDays = null,
        ?int $maxRolloverCount = null,
        ?string $name = null,
        CbbOverageBehavior|string|null $overageBehavior = null,
        ?bool $overageEnabled = null,
        ?int $overageLimit = null,
        ?string $pricePerUnit = null,
        ?bool $rolloverEnabled = null,
        ?int $rolloverPercentage = null,
        ?int $rolloverTimeframeCount = null,
        TimeInterval|string|null $rolloverTimeframeInterval = null,
        ?string $unit = null,
    ): self {
        $self = new self;

        null !== $currency && $self['currency'] = $currency;
        null !== $description && $self['description'] = $description;
        null !== $expiresAfterDays && $self['expiresAfterDays'] = $expiresAfterDays;
        null !== $maxRolloverCount && $self['maxRolloverCount'] = $maxRolloverCount;
        null !== $name && $self['name'] = $name;
        null !== $overageBehavior && $self['overageBehavior'] = $overageBehavior;
        null !== $overageEnabled && $self['overageEnabled'] = $overageEnabled;
        null !== $overageLimit && $self['overageLimit'] = $overageLimit;
        null !== $pricePerUnit && $self['pricePerUnit'] = $pricePerUnit;
        null !== $rolloverEnabled && $self['rolloverEnabled'] = $rolloverEnabled;
        null !== $rolloverPercentage && $self['rolloverPercentage'] = $rolloverPercentage;
        null !== $rolloverTimeframeCount && $self['rolloverTimeframeCount'] = $rolloverTimeframeCount;
        null !== $rolloverTimeframeInterval && $self['rolloverTimeframeInterval'] = $rolloverTimeframeInterval;
        null !== $unit && $self['unit'] = $unit;

        return $self;
    }

    /**
     * Currency for pricing.
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
     * Number of days after which credits expire.
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
     * Name of the credit entitlement.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Controls how overage is handled at billing cycle end.
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
     * Whether overage charges are enabled when credits run out.
     */
    public function withOverageEnabled(?bool $overageEnabled): self
    {
        $self = clone $this;
        $self['overageEnabled'] = $overageEnabled;

        return $self;
    }

    /**
     * Maximum overage units allowed.
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
     * Whether rollover is enabled for unused credits.
     */
    public function withRolloverEnabled(?bool $rolloverEnabled): self
    {
        $self = clone $this;
        $self['rolloverEnabled'] = $rolloverEnabled;

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

    /**
     * Unit of measurement for the credit (e.g., "API Calls", "Tokens", "Credits").
     */
    public function withUnit(?string $unit): self
    {
        $self = clone $this;
        $self['unit'] = $unit;

        return $self;
    }
}
