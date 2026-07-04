<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements;

/**
 * Type of capability a `feature_flag` entitlement confers.
 */
enum FeatureType: string
{
    case BOOLEAN = 'boolean';
}
