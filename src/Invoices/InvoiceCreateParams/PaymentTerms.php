<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\InvoiceCreateParams;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Invoices\InvoiceCreateParams\PaymentTerms\DueOnReceipt;
use Dodopayments\Invoices\InvoiceCreateParams\PaymentTerms\Net;

/**
 * Do not send it with `due_at`.
 *
 * @phpstan-import-type DueOnReceiptShape from \Dodopayments\Invoices\InvoiceCreateParams\PaymentTerms\DueOnReceipt
 * @phpstan-import-type NetShape from \Dodopayments\Invoices\InvoiceCreateParams\PaymentTerms\Net
 *
 * @phpstan-type PaymentTermsVariants = DueOnReceipt|Net
 * @phpstan-type PaymentTermsShape = PaymentTermsVariants|DueOnReceiptShape|NetShape
 */
final class PaymentTerms implements ConverterSource
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
        return ['due_on_receipt' => DueOnReceipt::class, 'net' => Net::class];
    }
}
