<?php

declare(strict_types=1);

namespace DodoPayments\Core\Contracts;

use DodoPayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @internal
 *
 * @extends \ArrayAccess<string, mixed>
 */
interface BaseModel extends \ArrayAccess, \JsonSerializable, \Stringable, ConverterSource
{
    /** @return array<string, mixed> */
    public function toArray(): array;
}
