<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

/**
 * Unit of a duration count (e.g. license-key validity period).
 */
enum TimeInterval: string
{
    case DAY = 'Day';

    case WEEK = 'Week';

    case MONTH = 'Month';

    case YEAR = 'Year';
}
