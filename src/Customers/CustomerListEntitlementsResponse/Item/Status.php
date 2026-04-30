<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerListEntitlementsResponse\Item;

enum Status: string
{
    case PENDING = 'pending';

    case DELIVERED = 'delivered';

    case FAILED = 'failed';

    case REVOKED = 'revoked';
}
