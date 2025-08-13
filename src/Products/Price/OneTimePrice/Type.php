<?php

declare(strict_types=1);

namespace Dodopayments\Products\Price\OneTimePrice;

use Dodopayments\Core\Concerns\Enum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type type_alias = Type::*
 */
final class Type implements ConverterSource
{
    use Enum;

    public const ONE_TIME_PRICE = 'one_time_price';
}
