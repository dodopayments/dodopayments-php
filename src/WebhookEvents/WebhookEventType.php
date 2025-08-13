<?php

declare(strict_types=1);

namespace DodoPayments\WebhookEvents;

use DodoPayments\Core\Concerns\Enum;
use DodoPayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Event types for Dodo events.
 *
 * @phpstan-type webhook_event_type_alias = WebhookEventType::*
 */
final class WebhookEventType implements ConverterSource
{
    use Enum;

    public const PAYMENT_SUCCEEDED = 'payment.succeeded';

    public const PAYMENT_FAILED = 'payment.failed';

    public const PAYMENT_PROCESSING = 'payment.processing';

    public const PAYMENT_CANCELLED = 'payment.cancelled';

    public const REFUND_SUCCEEDED = 'refund.succeeded';

    public const REFUND_FAILED = 'refund.failed';

    public const DISPUTE_OPENED = 'dispute.opened';

    public const DISPUTE_EXPIRED = 'dispute.expired';

    public const DISPUTE_ACCEPTED = 'dispute.accepted';

    public const DISPUTE_CANCELLED = 'dispute.cancelled';

    public const DISPUTE_CHALLENGED = 'dispute.challenged';

    public const DISPUTE_WON = 'dispute.won';

    public const DISPUTE_LOST = 'dispute.lost';

    public const SUBSCRIPTION_ACTIVE = 'subscription.active';

    public const SUBSCRIPTION_RENEWED = 'subscription.renewed';

    public const SUBSCRIPTION_ON_HOLD = 'subscription.on_hold';

    public const SUBSCRIPTION_CANCELLED = 'subscription.cancelled';

    public const SUBSCRIPTION_FAILED = 'subscription.failed';

    public const SUBSCRIPTION_EXPIRED = 'subscription.expired';

    public const SUBSCRIPTION_PLAN_CHANGED = 'subscription.plan_changed';

    public const LICENSE_KEY_CREATED = 'license_key.created';
}
