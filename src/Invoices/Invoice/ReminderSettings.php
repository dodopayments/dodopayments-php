<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Invoices\Invoice\ReminderSettings\UnionMember0;
use Dodopayments\Invoices\Invoice\ReminderSettings\UnionMember1;

/**
 * `null` on a draft that keeps all reminder settings of the business.
 *
 * @phpstan-import-type UnionMember0Shape from \Dodopayments\Invoices\Invoice\ReminderSettings\UnionMember0
 * @phpstan-import-type UnionMember1Shape from \Dodopayments\Invoices\Invoice\ReminderSettings\UnionMember1
 *
 * @phpstan-type ReminderSettingsVariants = UnionMember0|UnionMember1
 * @phpstan-type ReminderSettingsShape = ReminderSettingsVariants|UnionMember0Shape|UnionMember1Shape
 */
final class ReminderSettings implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [UnionMember0::class, UnionMember1::class];
    }
}
