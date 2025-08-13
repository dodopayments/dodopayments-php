<?php

declare(strict_types=1);

namespace DodopaymentsClient\Core\Conversion\Contracts;

use DodopaymentsClient\Core\Conversion\CoerceState;
use DodopaymentsClient\Core\Conversion\DumpState;

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
