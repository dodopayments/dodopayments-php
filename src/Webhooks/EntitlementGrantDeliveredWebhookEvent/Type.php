<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\EntitlementGrantDeliveredWebhookEvent;

/**
 * The event type.
 */
enum Type: string
{
    case ENTITLEMENT_GRANT_DELIVERED = 'entitlement_grant.delivered';
}
