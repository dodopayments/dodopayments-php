<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\ProductCollection;

/**
 * Default proration billing mode for subscription plan downgrades (null = inherit from business).
 */
enum ProrationBillingModeOnDowngrade: string
{
    case PRORATED_IMMEDIATELY = 'prorated_immediately';

    case FULL_IMMEDIATELY = 'full_immediately';

    case DIFFERENCE_IMMEDIATELY = 'difference_immediately';

    case DO_NOT_BILL = 'do_not_bill';
}
