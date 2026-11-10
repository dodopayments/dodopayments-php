<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Invoices\Invoice\Frequency\Mixed_;
use Dodopayments\Invoices\Invoice\Frequency\OneTime;
use Dodopayments\Invoices\Invoice\Frequency\Recurring;

/**
 * How often the invoice lines bill. `mixed` covers several intervals, or one-time lines next to a plan.
 *
 * @phpstan-import-type OneTimeShape from \Dodopayments\Invoices\Invoice\Frequency\OneTime
 * @phpstan-import-type RecurringShape from \Dodopayments\Invoices\Invoice\Frequency\Recurring
 * @phpstan-import-type MixedShape from \Dodopayments\Invoices\Invoice\Frequency\Mixed_
 *
 * @phpstan-type FrequencyVariants = OneTime|Recurring|Mixed_
 * @phpstan-type FrequencyShape = FrequencyVariants|OneTimeShape|RecurringShape|MixedShape
 */
final class Frequency implements ConverterSource
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
            'one_time' => OneTime::class,
            'recurring' => Recurring::class,
            'mixed' => Mixed_::class,
        ];
    }
}
