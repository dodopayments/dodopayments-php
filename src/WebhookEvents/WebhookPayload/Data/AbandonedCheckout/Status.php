<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\AbandonedCheckout;

enum Status: string
{
    case ABANDONED = 'abandoned';

    case RECOVERING = 'recovering';

    case RECOVERED = 'recovered';

    case EXHAUSTED = 'exhausted';

    case OPTED_OUT = 'opted_out';
}
