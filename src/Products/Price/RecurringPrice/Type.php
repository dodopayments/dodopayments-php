<?php

declare(strict_types=1);

namespace DodoPayments\Products\Price\RecurringPrice;

use DodoPayments\Core\Concerns\Enum;
use DodoPayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use Enum;

    public const RECURRING_PRICE = 'recurring_price';
}
