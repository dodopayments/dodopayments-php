<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\CreditOverageChargedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case CREDIT_OVERAGE_CHARGED = 'credit.overage_charged';
}
