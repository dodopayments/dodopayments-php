<?php

declare(strict_types=1);

namespace DodoPayments\Products;

use DodoPayments\Core\Concerns\Union;
use DodoPayments\Core\Conversion\Contracts\Converter;
use DodoPayments\Core\Conversion\Contracts\ConverterSource;
use DodoPayments\Products\Price\OneTimePrice;
use DodoPayments\Products\Price\RecurringPrice;

/**
 * One-time price details.
 *
 * @phpstan-type price_alias = OneTimePrice|RecurringPrice
 */
final class Price implements ConverterSource
{
    use Union;

    /**
     * @return array<string,
     * Converter|ConverterSource|string,>|list<Converter|ConverterSource|string>
     */
    public static function variants(): array
    {
        return [OneTimePrice::class, RecurringPrice::class];
    }
}
