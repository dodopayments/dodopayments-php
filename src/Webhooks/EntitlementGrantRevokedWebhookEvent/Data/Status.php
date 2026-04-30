<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\EntitlementGrantRevokedWebhookEvent\Data;

enum Status: string
{
    case PENDING = 'Pending';

    case DELIVERED = 'Delivered';

    case FAILED = 'Failed';

    case REVOKED = 'Revoked';
}
