<?php

declare(strict_types=1);

namespace Dodopayments\Core\Conversion;

use Dodopayments\Core\Conversion\Concerns\ArrayOf;
use Dodopayments\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
