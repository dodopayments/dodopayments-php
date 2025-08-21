<?php

declare(strict_types=1);

namespace Dodopayments\Misc;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Represents the different categories of taxation applicable to various products and services.
 *
 * @phpstan-type tax_category_alias = TaxCategory::*
 */
final class TaxCategory implements ConverterSource
{
    use SdkEnum;

    public const DIGITAL_PRODUCTS = 'digital_products';

    public const SAAS = 'saas';

    public const E_BOOK = 'e_book';

    public const EDTECH = 'edtech';
}
