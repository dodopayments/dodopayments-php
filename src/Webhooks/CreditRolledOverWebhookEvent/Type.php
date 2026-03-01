<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\CreditRolledOverWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case CREDIT_ROLLED_OVER = 'credit.rolled_over';
}
