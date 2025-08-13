<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys\LicenseKeyListParams;

use Dodopayments\Core\Concerns\Enum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Filter by license key status.
 *
 * @phpstan-type status_alias = Status::*
 */
final class Status implements ConverterSource
{
    use Enum;

    public const ACTIVE = 'active';

    public const EXPIRED = 'expired';

    public const DISABLED = 'disabled';
}
