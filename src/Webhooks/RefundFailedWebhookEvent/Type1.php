<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\RefundFailedWebhookEvent;

/**
 * The event type.
 */
enum Type1: string
{
    case REFUND_FAILED = 'refund.failed';
}
