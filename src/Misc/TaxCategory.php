<?php

declare(strict_types=1);

namespace DodoPayments\Misc;

use DodoPayments\Core\Concerns\Enum;
use DodoPayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Represents the different categories of taxation applicable to various products and services.
 *
 * @phpstan-type tax_category_alias = TaxCategory::*
 */
final class TaxCategory implements ConverterSource
{
    use Enum;

    public const DIGITAL_PRODUCTS = 'digital_products';

    public const SAAS = 'saas';

    public const E_BOOK = 'e_book';

    public const EDTECH = 'edtech';
}
