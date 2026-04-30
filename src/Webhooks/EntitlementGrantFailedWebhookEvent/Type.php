<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\EntitlementGrantFailedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case ENTITLEMENT_GRANT_FAILED = 'entitlement_grant.failed';
}
