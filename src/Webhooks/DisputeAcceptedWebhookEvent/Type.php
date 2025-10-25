<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DisputeAcceptedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case DISPUTE_ACCEPTED = 'dispute.accepted';
}
