<?php

declare(strict_types=1);

namespace Dodopayments\Products\ProductCreateParams;

/**
 * Pricing mode for localized pricing. When set, rules from
 * /products/{id}/localized-prices apply at checkout. NULL means base-only
 * (existing behavior).
 */
enum PricingMode: string
{
    case BY_CURRENCY = 'by_currency';

    case BY_COUNTRY = 'by_country';
}
