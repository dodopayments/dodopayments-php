<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\ProductCollectionCreateParams;

/**
 * Default behavior for subscription plan changes on payment failure (NULL = inherit from business).
 */
enum OnPaymentFailure: string
{
    case PREVENT_CHANGE = 'prevent_change';

    case APPLY_CHANGE = 'apply_change';
}
