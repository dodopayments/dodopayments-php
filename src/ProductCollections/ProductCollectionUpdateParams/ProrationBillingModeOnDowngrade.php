<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\ProductCollectionUpdateParams;

/**
 * Proration billing mode for downgrades: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change.
 */
enum ProrationBillingModeOnDowngrade: string
{
    case PRORATED_IMMEDIATELY = 'prorated_immediately';

    case FULL_IMMEDIATELY = 'full_immediately';

    case DIFFERENCE_IMMEDIATELY = 'difference_immediately';

    case DO_NOT_BILL = 'do_not_bill';
}
