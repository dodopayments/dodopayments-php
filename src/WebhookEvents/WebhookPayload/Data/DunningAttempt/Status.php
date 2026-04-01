<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\DunningAttempt;

enum Status: string
{
    case RECOVERING = 'recovering';

    case RECOVERED = 'recovered';

    case EXHAUSTED = 'exhausted';
}
