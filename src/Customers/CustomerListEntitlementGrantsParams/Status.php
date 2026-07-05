<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerListEntitlementGrantsParams;

/**
 * Filter by grant status.
 */
enum Status: string
{
    case PENDING = 'Pending';

    case DELIVERED = 'Delivered';

    case FAILED = 'Failed';

    case REVOKED = 'Revoked';
}
