<?php

declare(strict_types=1);

namespace Dodopayments\Discounts;

use Dodopayments\Core\Concerns\Enum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type discount_type_alias = DiscountType::*
 */
final class DiscountType implements ConverterSource
{
    use Enum;

    public const PERCENTAGE = 'percentage';
}
