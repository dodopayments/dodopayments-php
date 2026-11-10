<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice\Frequency;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * @phpstan-type RecurringShape = array{
 *   count: int, interval: TimeInterval|value-of<TimeInterval>, type: 'recurring'
 * }
 */
final class Recurring implements BaseModel
{
    /** @use SdkModel<RecurringShape> */
    use SdkModel;

    /** @var 'recurring' $type */
    #[Required]
    public string $type = 'recurring';

    #[Required]
    public int $count;

    /**
     * Unit of a duration count (e.g. license-key validity period).
     *
     * @var value-of<TimeInterval> $interval
     */
    #[Required(enum: TimeInterval::class)]
    public string $interval;

    /**
     * `new Recurring()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Recurring::with(count: ..., interval: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Recurring)->withCount(...)->withInterval(...)
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
     * Unit of a duration count (e.g. license-key validity period).
     *
     * @param TimeInterval|value-of<TimeInterval> $interval
     */
    public function withInterval(TimeInterval|string $interval): self
    {
        $self = clone $this;
        $self['interval'] = $interval;

        return $self;
    }

    /**
     * @param 'recurring' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
