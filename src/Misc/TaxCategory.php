<?php

declare(strict_types=1);

namespace DodopaymentsClient\Misc;

use DodopaymentsClient\Core\Concerns\Enum;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;

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
