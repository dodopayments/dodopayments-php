<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\ProductCollectionUpdateParams;

/**
 * On payment failure behavior: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change.
 */
enum OnPaymentFailure: string
{
    case PREVENT_CHANGE = 'prevent_change';

    case APPLY_CHANGE = 'apply_change';
}
