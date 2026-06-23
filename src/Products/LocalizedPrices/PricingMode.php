<?php

declare(strict_types=1);

namespace Dodopayments\Products\LocalizedPrices;

enum PricingMode: string
{
    case BY_CURRENCY = 'by_currency';

    case BY_COUNTRY = 'by_country';
}
