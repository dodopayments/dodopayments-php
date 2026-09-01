<?php

declare(strict_types=1);

namespace Dodopayments\Blocklist\Customers;

/**
 * Where a block came from. `Api` marks an API-key caller, which carries no
 * dashboard actor. The other values name the screen the merchant used.
 */
enum BlockedCustomerSource: string
{
    case BLOCKLIST_PAGE = 'blocklist_page';

    case CUSTOMER_PAGE = 'customer_page';

    case PAYMENT_PAGE = 'payment_page';

    case DISPUTE_PAGE = 'dispute_page';

    case API = 'api';
}
