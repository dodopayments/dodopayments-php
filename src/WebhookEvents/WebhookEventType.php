<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents;

/**
 * Event types for Dodo events.
 */
enum WebhookEventType: string
{
    case PAYMENT_SUCCEEDED = 'payment.succeeded';

    case PAYMENT_FAILED = 'payment.failed';

    case PAYMENT_PROCESSING = 'payment.processing';

    case PAYMENT_CANCELLED = 'payment.cancelled';

    case REFUND_SUCCEEDED = 'refund.succeeded';

    case REFUND_FAILED = 'refund.failed';

    case DISPUTE_OPENED = 'dispute.opened';

    case DISPUTE_EXPIRED = 'dispute.expired';

    case DISPUTE_ACCEPTED = 'dispute.accepted';

    case DISPUTE_CANCELLED = 'dispute.cancelled';

    case DISPUTE_CHALLENGED = 'dispute.challenged';

    case DISPUTE_WON = 'dispute.won';

    case DISPUTE_LOST = 'dispute.lost';

    case SUBSCRIPTION_ACTIVE = 'subscription.active';

    case SUBSCRIPTION_RENEWED = 'subscription.renewed';

    case SUBSCRIPTION_ON_HOLD = 'subscription.on_hold';

    case SUBSCRIPTION_CANCELLED = 'subscription.cancelled';

    case SUBSCRIPTION_FAILED = 'subscription.failed';

    case SUBSCRIPTION_EXPIRED = 'subscription.expired';

    case SUBSCRIPTION_PLAN_CHANGED = 'subscription.plan_changed';

    case SUBSCRIPTION_UPDATED = 'subscription.updated';

    case LICENSE_KEY_CREATED = 'license_key.created';

    case PAYOUT_NOT_INITIATED = 'payout.not_initiated';

    case PAYOUT_ON_HOLD = 'payout.on_hold';

    case PAYOUT_IN_PROGRESS = 'payout.in_progress';

    case PAYOUT_FAILED = 'payout.failed';

    case PAYOUT_SUCCESS = 'payout.success';

    case CREDIT_ADDED = 'credit.added';

    case CREDIT_DEDUCTED = 'credit.deducted';

    case CREDIT_EXPIRED = 'credit.expired';

    case CREDIT_ROLLED_OVER = 'credit.rolled_over';

    case CREDIT_ROLLOVER_FORFEITED = 'credit.rollover_forfeited';

    case CREDIT_OVERAGE_CHARGED = 'credit.overage_charged';

    case CREDIT_MANUAL_ADJUSTMENT = 'credit.manual_adjustment';

    case CREDIT_BALANCE_LOW = 'credit.balance_low';
}
