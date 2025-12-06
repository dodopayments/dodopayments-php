<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\RefundSucceededWebhookEvent;

/**
 * The event type.
 */
enum Type1: string
{
    case REFUND_SUCCEEDED = 'refund.succeeded';
}
