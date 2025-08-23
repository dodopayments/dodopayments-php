<?php

declare(strict_types=1);

namespace Dodopayments\Products\Price\RecurringPrice;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

final class Type implements ConverterSource
{
    use SdkEnum;

    public const RECURRING_PRICE = 'recurring_price';
}
