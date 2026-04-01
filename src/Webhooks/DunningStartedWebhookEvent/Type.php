<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DunningStartedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case DUNNING_STARTED = 'dunning.started';
}
