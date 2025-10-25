<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DisputeChallengedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case DISPUTE_CHALLENGED = 'dispute.challenged';
}
