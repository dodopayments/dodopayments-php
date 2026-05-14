<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\PaymentMethod\Existing;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\PaymentMethod\New_;

/**
 * @phpstan-import-type NewShape from \Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\PaymentMethod\New_
 * @phpstan-import-type ExistingShape from \Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\PaymentMethod\Existing
 *
 * @phpstan-type PaymentMethodVariants = New_|Existing
 * @phpstan-type PaymentMethodShape = PaymentMethodVariants|NewShape|ExistingShape
 */
final class PaymentMethod implements ConverterSource
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
        return ['new' => New_::class, 'existing' => Existing::class];
    }
}
