<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\InvoiceUpdateParams;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Invoices\InvoiceUpdateParams\PaymentTerms\Type;
use Dodopayments\Invoices\InvoiceUpdateParams\PaymentTerms\UnionMember1;

/**
 * @phpstan-import-type TypeShape from \Dodopayments\Invoices\InvoiceUpdateParams\PaymentTerms\Type
 * @phpstan-import-type UnionMember1Shape from \Dodopayments\Invoices\InvoiceUpdateParams\PaymentTerms\UnionMember1
 *
 * @phpstan-type PaymentTermsVariants = Type|UnionMember1
 * @phpstan-type PaymentTermsShape = PaymentTermsVariants|TypeShape|UnionMember1Shape
 */
final class PaymentTerms implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [Type::class, UnionMember1::class];
    }
}
