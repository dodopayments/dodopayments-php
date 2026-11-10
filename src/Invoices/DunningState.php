<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

enum DunningState: string
{
    case NOT_STARTED = 'not_started';

    case ACTIVE = 'active';

    case PAUSED = 'paused';

    case EXHAUSTED = 'exhausted';
}
