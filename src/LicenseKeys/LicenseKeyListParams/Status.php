<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys\LicenseKeyListParams;

/**
 * Filter by license key status.
 */
enum Status: string
{
    case ACTIVE = 'active';

    case EXPIRED = 'expired';

    case DISABLED = 'disabled';
}
