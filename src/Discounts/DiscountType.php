<?php

declare(strict_types=1);

namespace DodoPayments\Discounts;

use DodoPayments\Core\Concerns\Enum;
use DodoPayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type discount_type_alias = DiscountType::*
 */
final class DiscountType implements ConverterSource
{
    use Enum;

    public const PERCENTAGE = 'percentage';
}
