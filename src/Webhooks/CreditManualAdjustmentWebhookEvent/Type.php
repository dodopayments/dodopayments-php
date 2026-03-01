<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\CreditManualAdjustmentWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case CREDIT_MANUAL_ADJUSTMENT = 'credit.manual_adjustment';
}
