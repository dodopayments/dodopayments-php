<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\EntitlementGrantRevokedWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case ENTITLEMENT_GRANT_REVOKED = 'entitlement_grant.revoked';
}
