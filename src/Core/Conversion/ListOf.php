<?php

declare(strict_types=1);

namespace DodopaymentsClient\Core\Conversion;

use DodopaymentsClient\Core\Conversion\Concerns\ArrayOf;
use DodopaymentsClient\Core\Conversion\Contracts\Converter;

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
