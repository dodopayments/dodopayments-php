<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\ProductCollectionCreateParams;

/**
 * Default effective_at setting for subscription plan downgrades (NULL = inherit from business).
 */
enum EffectiveAtOnDowngrade: string
{
    case IMMEDIATELY = 'immediately';

    case NEXT_BILLING_DATE = 'next_billing_date';
}
