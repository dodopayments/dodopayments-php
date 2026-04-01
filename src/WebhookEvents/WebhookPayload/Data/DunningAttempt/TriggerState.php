<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\DunningAttempt;

enum TriggerState: string
{
    case ON_HOLD = 'on_hold';

    case CANCELLED = 'cancelled';
}
