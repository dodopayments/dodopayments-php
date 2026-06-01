<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\ProductCollectionCreateParams;

/**
 * Default proration billing mode for subscription plan upgrades (NULL = inherit from business).
 */
enum ProrationBillingModeOnUpgrade: string
{
    case PRORATED_IMMEDIATELY = 'prorated_immediately';

    case FULL_IMMEDIATELY = 'full_immediately';

    case DIFFERENCE_IMMEDIATELY = 'difference_immediately';

    case DO_NOT_BILL = 'do_not_bill';
}
