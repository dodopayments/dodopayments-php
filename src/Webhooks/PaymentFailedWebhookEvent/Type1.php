<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\PaymentFailedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case PAYMENT_FAILED = 'payment.failed';
}
