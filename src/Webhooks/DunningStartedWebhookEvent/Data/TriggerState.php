<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DunningStartedWebhookEvent\Data;

enum TriggerState: string
{
    case ON_HOLD = 'on_hold';

    case CANCELLED = 'cancelled';
}
