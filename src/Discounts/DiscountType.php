<?php

declare(strict_types=1);

namespace DodopaymentsClient\Discounts;

use DodopaymentsClient\Core\Concerns\Enum;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type discount_type_alias = DiscountType::*
 */
final class DiscountType implements ConverterSource
{
    use Enum;

    public const PERCENTAGE = 'percentage';
}
