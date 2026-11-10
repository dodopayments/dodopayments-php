<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanParams\Invoice;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanParams\Invoice\PaymentTerms\Type;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanParams\Invoice\PaymentTerms\UnionMember1;

/**
 * The terms of the plan-change invoice. The subscription terms apply when absent.
 *
 * @phpstan-import-type TypeShape from \Dodopayments\Subscriptions\SubscriptionPreviewChangePlanParams\Invoice\PaymentTerms\Type
 * @phpstan-import-type UnionMember1Shape from \Dodopayments\Subscriptions\SubscriptionPreviewChangePlanParams\Invoice\PaymentTerms\UnionMember1
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
