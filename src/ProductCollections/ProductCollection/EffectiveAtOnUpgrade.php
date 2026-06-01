<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\ProductCollection;

/**
 * Default effective_at setting for subscription plan upgrades (null = inherit from business).
 */
enum EffectiveAtOnUpgrade: string
{
    case IMMEDIATELY = 'immediately';

    case NEXT_BILLING_DATE = 'next_billing_date';
}
