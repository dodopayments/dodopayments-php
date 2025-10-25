<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\PaymentSucceededWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case PAYMENT_SUCCEEDED = 'payment.succeeded';
}
