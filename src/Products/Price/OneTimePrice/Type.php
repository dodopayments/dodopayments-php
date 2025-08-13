<?php

declare(strict_types=1);

namespace DodoPayments\Products\Price\OneTimePrice;

use DodoPayments\Core\Concerns\Enum;
use DodoPayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use Enum;

    public const ONE_TIME_PRICE = 'one_time_price';
}
