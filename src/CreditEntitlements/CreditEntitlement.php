<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * @phpstan-type CreditEntitlementShape = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   name: string,
 *   overageBehavior: CbbOverageBehavior|value-of<CbbOverageBehavior>,
 *   overageEnabled: bool,
 *   precision: int,
 *   rolloverEnabled: bool,
 *   unit: string,
 *   updatedAt: \DateTimeInterface,
 *   currency?: null|Currency|value-of<Currency>,
 *   description?: string|null,
 *   expiresAfterDays?: int|null,
 *   maxRolloverCount?: int|null,
 *   overageLimit?: int|null,
 *   pricePerUnit?: string|null,
 *   rolloverPercentage?: int|null,
 *   rolloverTimeframeCount?: int|null,
 *   rolloverTimeframeInterval?: null|TimeInterval|value-of<TimeInterval>,
 * }
 */
final class CreditEntitlement implements BaseModel
{
    /** @use SdkModel<CreditEntitlementShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('business_id')]
    public string $businessID;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required]
    public string $name;

    /**
     * Controls how overage is handled at billing cycle end.
     *
     * @var value-of<CbbOverageBehavior> $overageBehavior
     */
    #[Required('overage_behavior', enum: CbbOverageBehavior::class)]
    public string $overageBehavior;

    #[Required('overage_enabled')]
    public bool $overageEnabled;

    #[Required]
    public int $precision;

    #[Required('rollover_enabled')]
    public bool $rolloverEnabled;

    #[Required]
    public string $unit;

    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /** @var value-of<Currency>|null $currency */
    #[Optional(enum: Currency::class, nullable: true)]
    public ?string $currency;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional('expires_after_days', nullable: true)]
    public ?int $expiresAfterDays;

    #[Optional('max_rollover_count', nullable: true)]
    public ?int $maxRolloverCount;

    #[Optional('overage_limit', nullable: true)]
    public ?int $overageLimit;

    /**
     * Price per credit unit.
     */
    #[Optional('price_per_unit', nullable: true)]
    public ?string $pricePerUnit;

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
     * `new CreditEntitlement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditEntitlement::with(
     *   id: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   name: ...,
     *   overageBehavior: ...,
     *   overageEnabled: ...,
     *   precision: ...,
     *   rolloverEnabled: ...,
     *   unit: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditEntitlement)
     *   ->withID(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withName(...)
     *   ->withOverageBehavior(...)
     *   ->withOverageEnabled(...)
     *   ->withPrecision(...)
     *   ->withRolloverEnabled(...)
     *   ->withUnit(...)
     *   ->withUpdatedAt(...)
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
     * @param Currency|value-of<Currency>|null $currency
     * @param TimeInterval|value-of<TimeInterval>|null $rolloverTimeframeInterval
     */
    public static function with(
        string $id,
        string $businessID,
        \DateTimeInterface $createdAt,
        string $name,
        CbbOverageBehavior|string $overageBehavior,
        bool $overageEnabled,
        int $precision,
        bool $rolloverEnabled,
        string $unit,
        \DateTimeInterface $updatedAt,
        Currency|string|null $currency = null,
        ?string $description = null,
        ?int $expiresAfterDays = null,
        ?int $maxRolloverCount = null,
        ?int $overageLimit = null,
        ?string $pricePerUnit = null,
        ?int $rolloverPercentage = null,
        ?int $rolloverTimeframeCount = null,
        TimeInterval|string|null $rolloverTimeframeInterval = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['name'] = $name;
        $self['overageBehavior'] = $overageBehavior;
        $self['overageEnabled'] = $overageEnabled;
        $self['precision'] = $precision;
        $self['rolloverEnabled'] = $rolloverEnabled;
        $self['unit'] = $unit;
        $self['updatedAt'] = $updatedAt;

        null !== $currency && $self['currency'] = $currency;
        null !== $description && $self['description'] = $description;
        null !== $expiresAfterDays && $self['expiresAfterDays'] = $expiresAfterDays;
        null !== $maxRolloverCount && $self['maxRolloverCount'] = $maxRolloverCount;
        null !== $overageLimit && $self['overageLimit'] = $overageLimit;
        null !== $pricePerUnit && $self['pricePerUnit'] = $pricePerUnit;
        null !== $rolloverPercentage && $self['rolloverPercentage'] = $rolloverPercentage;
        null !== $rolloverTimeframeCount && $self['rolloverTimeframeCount'] = $rolloverTimeframeCount;
        null !== $rolloverTimeframeInterval && $self['rolloverTimeframeInterval'] = $rolloverTimeframeInterval;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

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

    public function withOverageEnabled(bool $overageEnabled): self
    {
        $self = clone $this;
        $self['overageEnabled'] = $overageEnabled;

        return $self;
    }

    public function withPrecision(int $precision): self
    {
        $self = clone $this;
        $self['precision'] = $precision;

        return $self;
    }

    public function withRolloverEnabled(bool $rolloverEnabled): self
    {
        $self = clone $this;
        $self['rolloverEnabled'] = $rolloverEnabled;

        return $self;
    }

    public function withUnit(string $unit): self
    {
        $self = clone $this;
        $self['unit'] = $unit;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency>|null $currency
     */
    public function withCurrency(Currency|string|null $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withExpiresAfterDays(?int $expiresAfterDays): self
    {
        $self = clone $this;
        $self['expiresAfterDays'] = $expiresAfterDays;

        return $self;
    }

    public function withMaxRolloverCount(?int $maxRolloverCount): self
    {
        $self = clone $this;
        $self['maxRolloverCount'] = $maxRolloverCount;

        return $self;
    }

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
