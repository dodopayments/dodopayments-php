<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type time_interval_alias = TimeInterval::*
 */
final class TimeInterval implements ConverterSource
{
    use SdkEnum;

    public const DAY = 'Day';

    public const WEEK = 'Week';

    public const MONTH = 'Month';

    public const YEAR = 'Year';
}
