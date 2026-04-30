<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Concerns\SdkUnion;
use Dodopayments\Core\Conversion\Contracts\Converter;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type AbandonedCheckoutDetectedWebhookEventShape from \Dodopayments\Webhooks\AbandonedCheckoutDetectedWebhookEvent
 * @phpstan-import-type AbandonedCheckoutRecoveredWebhookEventShape from \Dodopayments\Webhooks\AbandonedCheckoutRecoveredWebhookEvent
 * @phpstan-import-type CreditAddedWebhookEventShape from \Dodopayments\Webhooks\CreditAddedWebhookEvent
 * @phpstan-import-type CreditBalanceLowWebhookEventShape from \Dodopayments\Webhooks\CreditBalanceLowWebhookEvent
 * @phpstan-import-type CreditDeductedWebhookEventShape from \Dodopayments\Webhooks\CreditDeductedWebhookEvent
 * @phpstan-import-type CreditExpiredWebhookEventShape from \Dodopayments\Webhooks\CreditExpiredWebhookEvent
 * @phpstan-import-type CreditManualAdjustmentWebhookEventShape from \Dodopayments\Webhooks\CreditManualAdjustmentWebhookEvent
 * @phpstan-import-type CreditOverageChargedWebhookEventShape from \Dodopayments\Webhooks\CreditOverageChargedWebhookEvent
 * @phpstan-import-type CreditOverageResetWebhookEventShape from \Dodopayments\Webhooks\CreditOverageResetWebhookEvent
 * @phpstan-import-type CreditRolledOverWebhookEventShape from \Dodopayments\Webhooks\CreditRolledOverWebhookEvent
 * @phpstan-import-type CreditRolloverForfeitedWebhookEventShape from \Dodopayments\Webhooks\CreditRolloverForfeitedWebhookEvent
 * @phpstan-import-type DisputeAcceptedWebhookEventShape from \Dodopayments\Webhooks\DisputeAcceptedWebhookEvent
 * @phpstan-import-type DisputeCancelledWebhookEventShape from \Dodopayments\Webhooks\DisputeCancelledWebhookEvent
 * @phpstan-import-type DisputeChallengedWebhookEventShape from \Dodopayments\Webhooks\DisputeChallengedWebhookEvent
 * @phpstan-import-type DisputeExpiredWebhookEventShape from \Dodopayments\Webhooks\DisputeExpiredWebhookEvent
 * @phpstan-import-type DisputeLostWebhookEventShape from \Dodopayments\Webhooks\DisputeLostWebhookEvent
 * @phpstan-import-type DisputeOpenedWebhookEventShape from \Dodopayments\Webhooks\DisputeOpenedWebhookEvent
 * @phpstan-import-type DisputeWonWebhookEventShape from \Dodopayments\Webhooks\DisputeWonWebhookEvent
 * @phpstan-import-type DunningRecoveredWebhookEventShape from \Dodopayments\Webhooks\DunningRecoveredWebhookEvent
 * @phpstan-import-type DunningStartedWebhookEventShape from \Dodopayments\Webhooks\DunningStartedWebhookEvent
 * @phpstan-import-type EntitlementGrantCreatedWebhookEventShape from \Dodopayments\Webhooks\EntitlementGrantCreatedWebhookEvent
 * @phpstan-import-type EntitlementGrantDeliveredWebhookEventShape from \Dodopayments\Webhooks\EntitlementGrantDeliveredWebhookEvent
 * @phpstan-import-type EntitlementGrantFailedWebhookEventShape from \Dodopayments\Webhooks\EntitlementGrantFailedWebhookEvent
 * @phpstan-import-type EntitlementGrantRevokedWebhookEventShape from \Dodopayments\Webhooks\EntitlementGrantRevokedWebhookEvent
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
 * @phpstan-type UnsafeUnwrapWebhookEventVariants = AbandonedCheckoutDetectedWebhookEvent|AbandonedCheckoutRecoveredWebhookEvent|CreditAddedWebhookEvent|CreditBalanceLowWebhookEvent|CreditDeductedWebhookEvent|CreditExpiredWebhookEvent|CreditManualAdjustmentWebhookEvent|CreditOverageChargedWebhookEvent|CreditOverageResetWebhookEvent|CreditRolledOverWebhookEvent|CreditRolloverForfeitedWebhookEvent|DisputeAcceptedWebhookEvent|DisputeCancelledWebhookEvent|DisputeChallengedWebhookEvent|DisputeExpiredWebhookEvent|DisputeLostWebhookEvent|DisputeOpenedWebhookEvent|DisputeWonWebhookEvent|DunningRecoveredWebhookEvent|DunningStartedWebhookEvent|EntitlementGrantCreatedWebhookEvent|EntitlementGrantDeliveredWebhookEvent|EntitlementGrantFailedWebhookEvent|EntitlementGrantRevokedWebhookEvent|LicenseKeyCreatedWebhookEvent|PaymentCancelledWebhookEvent|PaymentFailedWebhookEvent|PaymentProcessingWebhookEvent|PaymentSucceededWebhookEvent|RefundFailedWebhookEvent|RefundSucceededWebhookEvent|SubscriptionActiveWebhookEvent|SubscriptionCancelledWebhookEvent|SubscriptionExpiredWebhookEvent|SubscriptionFailedWebhookEvent|SubscriptionOnHoldWebhookEvent|SubscriptionPlanChangedWebhookEvent|SubscriptionRenewedWebhookEvent|SubscriptionUpdatedWebhookEvent
 * @phpstan-type UnsafeUnwrapWebhookEventShape = UnsafeUnwrapWebhookEventVariants|AbandonedCheckoutDetectedWebhookEventShape|AbandonedCheckoutRecoveredWebhookEventShape|CreditAddedWebhookEventShape|CreditBalanceLowWebhookEventShape|CreditDeductedWebhookEventShape|CreditExpiredWebhookEventShape|CreditManualAdjustmentWebhookEventShape|CreditOverageChargedWebhookEventShape|CreditOverageResetWebhookEventShape|CreditRolledOverWebhookEventShape|CreditRolloverForfeitedWebhookEventShape|DisputeAcceptedWebhookEventShape|DisputeCancelledWebhookEventShape|DisputeChallengedWebhookEventShape|DisputeExpiredWebhookEventShape|DisputeLostWebhookEventShape|DisputeOpenedWebhookEventShape|DisputeWonWebhookEventShape|DunningRecoveredWebhookEventShape|DunningStartedWebhookEventShape|EntitlementGrantCreatedWebhookEventShape|EntitlementGrantDeliveredWebhookEventShape|EntitlementGrantFailedWebhookEventShape|EntitlementGrantRevokedWebhookEventShape|LicenseKeyCreatedWebhookEventShape|PaymentCancelledWebhookEventShape|PaymentFailedWebhookEventShape|PaymentProcessingWebhookEventShape|PaymentSucceededWebhookEventShape|RefundFailedWebhookEventShape|RefundSucceededWebhookEventShape|SubscriptionActiveWebhookEventShape|SubscriptionCancelledWebhookEventShape|SubscriptionExpiredWebhookEventShape|SubscriptionFailedWebhookEventShape|SubscriptionOnHoldWebhookEventShape|SubscriptionPlanChangedWebhookEventShape|SubscriptionRenewedWebhookEventShape|SubscriptionUpdatedWebhookEventShape
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
            AbandonedCheckoutDetectedWebhookEvent::class,
            AbandonedCheckoutRecoveredWebhookEvent::class,
            CreditAddedWebhookEvent::class,
            CreditBalanceLowWebhookEvent::class,
            CreditDeductedWebhookEvent::class,
            CreditExpiredWebhookEvent::class,
            CreditManualAdjustmentWebhookEvent::class,
            CreditOverageChargedWebhookEvent::class,
            CreditOverageResetWebhookEvent::class,
            CreditRolledOverWebhookEvent::class,
            CreditRolloverForfeitedWebhookEvent::class,
            DisputeAcceptedWebhookEvent::class,
            DisputeCancelledWebhookEvent::class,
            DisputeChallengedWebhookEvent::class,
            DisputeExpiredWebhookEvent::class,
            DisputeLostWebhookEvent::class,
            DisputeOpenedWebhookEvent::class,
            DisputeWonWebhookEvent::class,
            DunningRecoveredWebhookEvent::class,
            DunningStartedWebhookEvent::class,
            EntitlementGrantCreatedWebhookEvent::class,
            EntitlementGrantDeliveredWebhookEvent::class,
            EntitlementGrantFailedWebhookEvent::class,
            EntitlementGrantRevokedWebhookEvent::class,
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
