<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\UpdateSubscriptionPlanReq\Invoice;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Subscriptions\UpdateSubscriptionPlanReq\Invoice\PaymentTerms\DueOnReceipt;
use Dodopayments\Subscriptions\UpdateSubscriptionPlanReq\Invoice\PaymentTerms\Net;

/**
 * The terms of the plan-change invoice. The subscription terms apply when absent.
 *
 * @phpstan-import-type DueOnReceiptShape from \Dodopayments\Subscriptions\UpdateSubscriptionPlanReq\Invoice\PaymentTerms\DueOnReceipt
 * @phpstan-import-type NetShape from \Dodopayments\Subscriptions\UpdateSubscriptionPlanReq\Invoice\PaymentTerms\Net
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
