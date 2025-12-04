<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\PaymentProcessingWebhookEvent;

/**
 * The event type.
 */
enum Type1: string
{
    case PAYMENT_PROCESSING = 'payment.processing';
}
