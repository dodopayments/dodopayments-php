<?php

declare(strict_types=1);

namespace Dodopayments\Misc;

/**
 * Represents the different categories of taxation applicable to various products and services.
 */
enum TaxCategory: string
{
    case DIGITAL_PRODUCTS = 'digital_products';

    case SAAS = 'saas';

    case E_BOOK = 'e_book';

    case EDTECH = 'edtech';
}
