<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\EntitlementGrantCreatedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case ENTITLEMENT_GRANT_CREATED = 'entitlement_grant.created';
}
