<?php

declare(strict_types=1);

namespace Dodopayments\Discounts;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

final class DiscountType implements ConverterSource
{
    use SdkEnum;

    public const PERCENTAGE = 'percentage';
}
