<?php

declare(strict_types=1);

namespace Dodopayments\Products\Price\UsageBasedPrice;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

final class Type implements ConverterSource
{
    use SdkEnum;

    public const USAGE_BASED_PRICE = 'usage_based_price';
}
