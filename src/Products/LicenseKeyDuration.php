<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * @phpstan-type LicenseKeyDurationShape = array{
 *   count: int, interval: value-of<TimeInterval>
 * }
 */
final class LicenseKeyDuration implements BaseModel
{
    /** @use SdkModel<LicenseKeyDurationShape> */
    use SdkModel;

    #[Api]
    public int $count;

    /** @var value-of<TimeInterval> $interval */
    #[Api(enum: TimeInterval::class)]
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
        $obj = new self;

        $obj->count = $count;
        $obj['interval'] = $interval;

        return $obj;
    }

    public function withCount(int $count): self
    {
        $obj = clone $this;
        $obj->count = $count;

        return $obj;
    }

    /**
     * @param TimeInterval|value-of<TimeInterval> $interval
     */
    public function withInterval(TimeInterval|string $interval): self
    {
        $obj = clone $this;
        $obj['interval'] = $interval;

        return $obj;
    }
}
