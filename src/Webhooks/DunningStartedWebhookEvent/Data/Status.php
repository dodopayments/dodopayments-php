<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DunningStartedWebhookEvent\Data;

enum Status: string
{
    case RECOVERING = 'recovering';

    case RECOVERED = 'recovered';

    case EXHAUSTED = 'exhausted';
}
