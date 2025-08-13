<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * @phpstan-type license_key_duration_alias = array{
 *   count: int, interval: TimeInterval::*
 * }
 */
final class LicenseKeyDuration implements BaseModel
{
    use Model;

    #[Api]
    public int $count;

    /** @var TimeInterval::* $interval */
    #[Api(enum: TimeInterval::class)]
    public string $interval;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param TimeInterval::* $interval
     */
    public static function from(int $count, string $interval): self
    {
        $obj = new self;

        $obj->count = $count;
        $obj->interval = $interval;

        return $obj;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @param TimeInterval::* $interval
     */
    public function setInterval(string $interval): self
    {
        $this->interval = $interval;

        return $this;
    }
}
