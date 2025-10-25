<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DisputeWonWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case DISPUTE_WON = 'dispute.won';
}
