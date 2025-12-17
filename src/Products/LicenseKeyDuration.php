<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * @phpstan-type LicenseKeyDurationShape = array{
 *   count: int, interval: TimeInterval|value-of<TimeInterval>
 * }
 */
final class LicenseKeyDuration implements BaseModel
{
    /** @use SdkModel<LicenseKeyDurationShape> */
    use SdkModel;

    #[Required]
    public int $count;

    /** @var value-of<TimeInterval> $interval */
    #[Required(enum: TimeInterval::class)]
    public string $interval;

    /**
     * `new LicenseKeyDuration()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseKeyDuration::with(count: ..., interval: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseKeyDuration)->withCount(...)->withInterval(...)
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
     * @param TimeInterval|value-of<TimeInterval> $interval
     */
    public static function with(int $count, TimeInterval|string $interval): self
    {
        $self = new self;

        $self['count'] = $count;
        $self['interval'] = $interval;

        return $self;
    }

    public function withCount(int $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }

    /**
     * @param TimeInterval|value-of<TimeInterval> $interval
     */
    public function withInterval(TimeInterval|string $interval): self
    {
        $self = clone $this;
        $self['interval'] = $interval;

        return $self;
    }
}
