<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Invoices\Invoice\Frequency\Type;
use Dodopayments\Invoices\Invoice\Frequency\Type1;
use Dodopayments\Invoices\Invoice\Frequency\UnionMember1;

/**
 * How often the invoice lines bill. `mixed` covers several intervals, or one-time lines next to a plan.
 *
 * @phpstan-import-type TypeShape from \Dodopayments\Invoices\Invoice\Frequency\Type
 * @phpstan-import-type UnionMember1Shape from \Dodopayments\Invoices\Invoice\Frequency\UnionMember1
 * @phpstan-import-type Type1Shape from \Dodopayments\Invoices\Invoice\Frequency\Type1
 *
 * @phpstan-type FrequencyVariants = Type|UnionMember1|Type1
 * @phpstan-type FrequencyShape = FrequencyVariants|TypeShape|UnionMember1Shape|Type1Shape
 */
final class Frequency implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [Type::class, UnionMember1::class, Type1::class];
    }
}
