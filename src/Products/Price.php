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
 * @phpstan-type PriceVariants = OneTimePrice|RecurringPrice|UsageBasedPrice
 * @phpstan-type PriceShape = PriceVariants|OneTimePriceShape|RecurringPriceShape|UsageBasedPriceShape
 */
final class Price implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'type';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'one_time_price' => OneTimePrice::class,
            'recurring_price' => RecurringPrice::class,
            'usage_based_price' => UsageBasedPrice::class,
        ];
    }
}
