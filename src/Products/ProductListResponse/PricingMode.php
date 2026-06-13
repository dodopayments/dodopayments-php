<?php

declare(strict_types=1);

namespace Dodopayments\Products\ProductListResponse;

/**
 * Pricing mode for localized pricing. NULL means base-only (no localized rules apply).
 */
enum PricingMode: string
{
    case BY_CURRENCY = 'by_currency';

    case BY_COUNTRY = 'by_country';
}
