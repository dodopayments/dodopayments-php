<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\ProductCollectionUpdateParams;

/**
 * Effective_at setting for downgrades: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change.
 */
enum EffectiveAtOnDowngrade: string
{
    case IMMEDIATELY = 'immediately';

    case NEXT_BILLING_DATE = 'next_billing_date';
}
