<?php

declare(strict_types=1);

namespace Dodopayments\Core\Conversion;

use Dodopayments\Core\Conversion\Concerns\ArrayOf;
use Dodopayments\Core\Conversion\Contracts\Converter;

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
