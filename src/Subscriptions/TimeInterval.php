<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

enum TimeInterval: string
{
    case DAY = 'Day';

    case WEEK = 'Week';

    case MONTH = 'Month';

    case YEAR = 'Year';
}
