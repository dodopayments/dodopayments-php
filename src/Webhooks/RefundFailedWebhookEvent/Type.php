<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\RefundFailedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case REFUND_FAILED = 'refund.failed';
}
