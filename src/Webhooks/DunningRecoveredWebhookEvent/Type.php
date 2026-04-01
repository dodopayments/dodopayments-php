<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\DunningRecoveredWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case DUNNING_RECOVERED = 'dunning.recovered';
}
