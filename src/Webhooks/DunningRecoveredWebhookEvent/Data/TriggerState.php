<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DunningRecoveredWebhookEvent\Data;

enum TriggerState: string
{
    case ON_HOLD = 'on_hold';

    case CANCELLED = 'cancelled';
}
