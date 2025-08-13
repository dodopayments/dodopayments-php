<?php

declare(strict_types=1);

namespace DodoPayments\Core\Conversion;

use DodoPayments\Core\Conversion\Concerns\ArrayOf;
use DodoPayments\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
