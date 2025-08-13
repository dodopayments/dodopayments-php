<?php

declare(strict_types=1);

namespace DodoPayments\Core\Conversion\Contracts;

use DodoPayments\Core\Conversion\CoerceState;
use DodoPayments\Core\Conversion\DumpState;

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
