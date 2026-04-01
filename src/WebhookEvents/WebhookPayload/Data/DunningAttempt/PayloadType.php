<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\DunningAttempt;

enum PayloadType: string
{
    case DUNNING_ATTEMPT = 'DunningAttempt';
}
