<?php

declare(strict_types=1);

namespace Dodopayments\Core\Conversion\Contracts;

use Dodopayments\Core\Conversion\CoerceState;
use Dodopayments\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
