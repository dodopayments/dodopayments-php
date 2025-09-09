<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterAggregation;

/**
 * Aggregation type for the meter.
 */
enum Type: string
{
    case COUNT = 'count';

    case SUM = 'sum';

    case MAX = 'max';

    case LAST = 'last';
}
