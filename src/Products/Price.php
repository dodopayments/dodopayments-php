<?php

declare(strict_types=1);

namespace DodopaymentsClient\Products;

use DodopaymentsClient\Core\Concerns\Union;
use DodopaymentsClient\Core\Conversion\Contracts\Converter;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;
use DodopaymentsClient\Products\Price\OneTimePrice;
use DodopaymentsClient\Products\Price\RecurringPrice;

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
