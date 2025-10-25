<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

final class UnwrapWebhookEvent implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [
            DisputeAcceptedWebhookEvent::class,
            DisputeCancelledWebhookEvent::class,
            DisputeChallengedWebhookEvent::class,
            DisputeExpiredWebhookEvent::class,
            DisputeLostWebhookEvent::class,
            DisputeOpenedWebhookEvent::class,
            DisputeWonWebhookEvent::class,
            LicenseKeyCreatedWebhookEvent::class,
            PaymentCancelledWebhookEvent::class,
            PaymentFailedWebhookEvent::class,
            PaymentProcessingWebhookEvent::class,
            PaymentSucceededWebhookEvent::class,
            RefundFailedWebhookEvent::class,
            RefundSucceededWebhookEvent::class,
            SubscriptionActiveWebhookEvent::class,
            SubscriptionCancelledWebhookEvent::class,
            SubscriptionExpiredWebhookEvent::class,
            SubscriptionFailedWebhookEvent::class,
            SubscriptionOnHoldWebhookEvent::class,
            SubscriptionPlanChangedWebhookEvent::class,
            SubscriptionRenewedWebhookEvent::class,
        ];
    }
}
