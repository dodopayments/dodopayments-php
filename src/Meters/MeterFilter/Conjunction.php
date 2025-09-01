<?php

declare(strict_types=1);

namespace Dodopayments\Meters\MeterFilter;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Logical conjunction to apply between clauses (and/or).
 */
final class Conjunction implements ConverterSource
{
    use SdkEnum;

    public const AND = 'and';

    public const OR = 'or';
}
