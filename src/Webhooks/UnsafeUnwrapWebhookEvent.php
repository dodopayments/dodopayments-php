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

    public static function discriminator(): string
    {
        return 'type';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'abandoned_checkout.detected' => AbandonedCheckoutDetectedWebhookEvent::class,
            'abandoned_checkout.recovered' => AbandonedCheckoutRecoveredWebhookEvent::class,
            'credit.added' => CreditAddedWebhookEvent::class,
            'credit.balance_low' => CreditBalanceLowWebhookEvent::class,
            'credit.deducted' => CreditDeductedWebhookEvent::class,
            'credit.expired' => CreditExpiredWebhookEvent::class,
            'credit.manual_adjustment' => CreditManualAdjustmentWebhookEvent::class,
            'credit.overage_charged' => CreditOverageChargedWebhookEvent::class,
            'credit.overage_reset' => CreditOverageResetWebhookEvent::class,
            'credit.rolled_over' => CreditRolledOverWebhookEvent::class,
            'credit.rollover_forfeited' => CreditRolloverForfeitedWebhookEvent::class,
            'dispute.accepted' => DisputeAcceptedWebhookEvent::class,
            'dispute.cancelled' => DisputeCancelledWebhookEvent::class,
            'dispute.challenged' => DisputeChallengedWebhookEvent::class,
            'dispute.expired' => DisputeExpiredWebhookEvent::class,
            'dispute.lost' => DisputeLostWebhookEvent::class,
            'dispute.opened' => DisputeOpenedWebhookEvent::class,
            'dispute.won' => DisputeWonWebhookEvent::class,
            'dunning.recovered' => DunningRecoveredWebhookEvent::class,
            'dunning.started' => DunningStartedWebhookEvent::class,
            'entitlement_grant.created' => EntitlementGrantCreatedWebhookEvent::class,
            'entitlement_grant.delivered' => EntitlementGrantDeliveredWebhookEvent::class,
            'entitlement_grant.failed' => EntitlementGrantFailedWebhookEvent::class,
            'entitlement_grant.revoked' => EntitlementGrantRevokedWebhookEvent::class,
            'license_key.created' => LicenseKeyCreatedWebhookEvent::class,
            'payment.cancelled' => PaymentCancelledWebhookEvent::class,
            'payment.failed' => PaymentFailedWebhookEvent::class,
            'payment.processing' => PaymentProcessingWebhookEvent::class,
            'payment.succeeded' => PaymentSucceededWebhookEvent::class,
            'refund.failed' => RefundFailedWebhookEvent::class,
            'refund.succeeded' => RefundSucceededWebhookEvent::class,
            'subscription.active' => SubscriptionActiveWebhookEvent::class,
            'subscription.cancelled' => SubscriptionCancelledWebhookEvent::class,
            'subscription.expired' => SubscriptionExpiredWebhookEvent::class,
            'subscription.failed' => SubscriptionFailedWebhookEvent::class,
            'subscription.on_hold' => SubscriptionOnHoldWebhookEvent::class,
            'subscription.plan_changed' => SubscriptionPlanChangedWebhookEvent::class,
            'subscription.renewed' => SubscriptionRenewedWebhookEvent::class,
            'subscription.updated' => SubscriptionUpdatedWebhookEvent::class,
        ];
    }
}
