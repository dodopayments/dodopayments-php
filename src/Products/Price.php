<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\RecurringPrice;
use Dodopayments\Products\Price\UsageBasedPrice;

/**
 * One-time price details.
 *
 * @phpstan-import-type OneTimePriceShape from \Dodopayments\Products\Price\OneTimePrice
 * @phpstan-import-type RecurringPriceShape from \Dodopayments\Products\Price\RecurringPrice
 * @phpstan-import-type UsageBasedPriceShape from \Dodopayments\Products\Price\UsageBasedPrice
 *
 * @phpstan-type PriceShape = OneTimePriceShape|RecurringPriceShape|UsageBasedPriceShape
 */
final class Price implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [OneTimePrice::class, RecurringPrice::class, UsageBasedPrice::class];
    }
}
