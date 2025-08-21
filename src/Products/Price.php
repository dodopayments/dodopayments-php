<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\RecurringPrice;

/**
 * One-time price details.
 *
 * @phpstan-type price_alias = OneTimePrice|RecurringPrice
 */
final class Price implements ConverterSource
{
    use SdkUnion;

    /**
     * @return array<string,
     * Converter|ConverterSource|string,>|list<Converter|ConverterSource|string>
     */
    public static function variants(): array
    {
        return [OneTimePrice::class, RecurringPrice::class];
    }
}
