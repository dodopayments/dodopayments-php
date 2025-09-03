<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterAggregation;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Aggregation type for the meter.
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const COUNT = 'count';

    public const SUM = 'sum';

    public const MAX = 'max';

    public const LAST = 'last';
}
