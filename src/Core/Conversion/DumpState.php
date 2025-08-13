<?php

declare(strict_types=1);

namespace DodopaymentsClient\Core\Conversion;

/**
 * @internal
 */
final class DumpState
{
    public function __construct(
        public bool $canRetry = true
    ) {}
}
