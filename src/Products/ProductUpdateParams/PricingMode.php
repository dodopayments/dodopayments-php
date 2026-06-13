<?php

declare(strict_types=1);

namespace Dodopayments\Products\ProductUpdateParams;

/**
 * Update the pricing mode. Omit to leave unchanged; set to null to clear
 * (which archives all active localized rules for this product). Changing
 * to a different non-null mode also archives any rules whose mode doesn't
 * match the new mode.
 */
enum PricingMode: string
{
    case BY_CURRENCY = 'by_currency';

    case BY_COUNTRY = 'by_country';
}
