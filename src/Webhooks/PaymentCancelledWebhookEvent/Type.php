<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\PaymentCancelledWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case PAYMENT_CANCELLED = 'payment.cancelled';
}
