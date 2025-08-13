<?php

declare(strict_types=1);

namespace DodoPayments\Core\Conversion;

use DodoPayments\Core\Conversion\Concerns\ArrayOf;
use DodoPayments\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    private function empty(): array|object // @phpstan-ignore-line
    {
        return [];
    }
}
