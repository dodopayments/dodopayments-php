<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type DisputeAcceptedWebhookEventShape from \Dodopayments\Webhooks\DisputeAcceptedWebhookEvent
 * @phpstan-import-type DisputeCancelledWebhookEventShape from \Dodopayments\Webhooks\DisputeCancelledWebhookEvent
 * @phpstan-import-type DisputeChallengedWebhookEventShape from \Dodopayments\Webhooks\DisputeChallengedWebhookEvent
 * @phpstan-import-type DisputeExpiredWebhookEventShape from \Dodopayments\Webhooks\DisputeExpiredWebhookEvent
 * @phpstan-import-type DisputeLostWebhookEventShape from \Dodopayments\Webhooks\DisputeLostWebhookEvent
 * @phpstan-import-type DisputeOpenedWebhookEventShape from \Dodopayments\Webhooks\DisputeOpenedWebhookEvent
 * @phpstan-import-type DisputeWonWebhookEventShape from \Dodopayments\Webhooks\DisputeWonWebhookEvent
 * @phpstan-import-type LicenseKeyCreatedWebhookEventShape from \Dodopayments\Webhooks\LicenseKeyCreatedWebhookEvent
 * @phpstan-import-type PaymentCancelledWebhookEventShape from \Dodopayments\Webhooks\PaymentCancelledWebhookEvent
 * @phpstan-import-type PaymentFailedWebhookEventShape from \Dodopayments\Webhooks\PaymentFailedWebhookEvent
 * @phpstan-import-type PaymentProcessingWebhookEventShape from \Dodopayments\Webhooks\PaymentProcessingWebhookEvent
 * @phpstan-import-type PaymentSucceededWebhookEventShape from \Dodopayments\Webhooks\PaymentSucceededWebhookEvent
 * @phpstan-import-type RefundFailedWebhookEventShape from \Dodopayments\Webhooks\RefundFailedWebhookEvent
 * @phpstan-import-type RefundSucceededWebhookEventShape from \Dodopayments\Webhooks\RefundSucceededWebhookEvent
 * @phpstan-import-type SubscriptionActiveWebhookEventShape from \Dodopayments\Webhooks\SubscriptionActiveWebhookEvent
 * @phpstan-import-type SubscriptionCancelledWebhookEventShape from \Dodopayments\Webhooks\SubscriptionCancelledWebhookEvent
 * @phpstan-import-type SubscriptionExpiredWebhookEventShape from \Dodopayments\Webhooks\SubscriptionExpiredWebhookEvent
 * @phpstan-import-type SubscriptionFailedWebhookEventShape from \Dodopayments\Webhooks\SubscriptionFailedWebhookEvent
 * @phpstan-import-type SubscriptionOnHoldWebhookEventShape from \Dodopayments\Webhooks\SubscriptionOnHoldWebhookEvent
 * @phpstan-import-type SubscriptionPlanChangedWebhookEventShape from \Dodopayments\Webhooks\SubscriptionPlanChangedWebhookEvent
 * @phpstan-import-type SubscriptionRenewedWebhookEventShape from \Dodopayments\Webhooks\SubscriptionRenewedWebhookEvent
 * @phpstan-import-type SubscriptionUpdatedWebhookEventShape from \Dodopayments\Webhooks\SubscriptionUpdatedWebhookEvent
 *
 * @phpstan-type UnsafeUnwrapWebhookEventVariants = DisputeAcceptedWebhookEvent|DisputeCancelledWebhookEvent|DisputeChallengedWebhookEvent|DisputeExpiredWebhookEvent|DisputeLostWebhookEvent|DisputeOpenedWebhookEvent|DisputeWonWebhookEvent|LicenseKeyCreatedWebhookEvent|PaymentCancelledWebhookEvent|PaymentFailedWebhookEvent|PaymentProcessingWebhookEvent|PaymentSucceededWebhookEvent|RefundFailedWebhookEvent|RefundSucceededWebhookEvent|SubscriptionActiveWebhookEvent|SubscriptionCancelledWebhookEvent|SubscriptionExpiredWebhookEvent|SubscriptionFailedWebhookEvent|SubscriptionOnHoldWebhookEvent|SubscriptionPlanChangedWebhookEvent|SubscriptionRenewedWebhookEvent|SubscriptionUpdatedWebhookEvent
 * @phpstan-type UnsafeUnwrapWebhookEventShape = UnsafeUnwrapWebhookEventVariants|DisputeAcceptedWebhookEventShape|DisputeCancelledWebhookEventShape|DisputeChallengedWebhookEventShape|DisputeExpiredWebhookEventShape|DisputeLostWebhookEventShape|DisputeOpenedWebhookEventShape|DisputeWonWebhookEventShape|LicenseKeyCreatedWebhookEventShape|PaymentCancelledWebhookEventShape|PaymentFailedWebhookEventShape|PaymentProcessingWebhookEventShape|PaymentSucceededWebhookEventShape|RefundFailedWebhookEventShape|RefundSucceededWebhookEventShape|SubscriptionActiveWebhookEventShape|SubscriptionCancelledWebhookEventShape|SubscriptionExpiredWebhookEventShape|SubscriptionFailedWebhookEventShape|SubscriptionOnHoldWebhookEventShape|SubscriptionPlanChangedWebhookEventShape|SubscriptionRenewedWebhookEventShape|SubscriptionUpdatedWebhookEventShape
 */
final class UnsafeUnwrapWebhookEvent implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
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
            SubscriptionUpdatedWebhookEvent::class,
        ];
    }
}
