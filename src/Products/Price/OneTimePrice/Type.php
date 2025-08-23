<?php

declare(strict_types=1);

namespace Dodopayments\Products\Price\OneTimePrice;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

final class Type implements ConverterSource
{
    use SdkEnum;

    public const ONE_TIME_PRICE = 'one_time_price';
}
