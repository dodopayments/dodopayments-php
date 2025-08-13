<?php

declare(strict_types=1);

namespace DodopaymentsClient\Products\Price\RecurringPrice;

use DodopaymentsClient\Core\Concerns\Enum;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use Enum;

    public const RECURRING_PRICE = 'recurring_price';
}
