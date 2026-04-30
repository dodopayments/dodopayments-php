<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\Grants\GrantRevokeResponse;

enum Status: string
{
    case PENDING = 'Pending';

    case DELIVERED = 'Delivered';

    case FAILED = 'Failed';

    case REVOKED = 'Revoked';
}
