<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\CreditBalanceLowWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case CREDIT_BALANCE_LOW = 'credit.balance_low';
}
