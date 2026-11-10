<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\InvoicePreviewParams;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Invoices\InvoicePreviewParams\PaymentTerms\Type;
use Dodopayments\Invoices\InvoicePreviewParams\PaymentTerms\UnionMember1;

/**
 * Do not send it with `due_at`.
 *
 * @phpstan-import-type TypeShape from \Dodopayments\Invoices\InvoicePreviewParams\PaymentTerms\Type
 * @phpstan-import-type UnionMember1Shape from \Dodopayments\Invoices\InvoicePreviewParams\PaymentTerms\UnionMember1
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
