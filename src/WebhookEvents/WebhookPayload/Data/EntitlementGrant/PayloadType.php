<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\EntitlementGrant;

enum PayloadType: string
{
    case ENTITLEMENT_GRANT = 'EntitlementGrant';
}
