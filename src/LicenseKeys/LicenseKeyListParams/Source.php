<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys\LicenseKeyListParams;

/**
 * Filter by license key source.
 */
enum Source: string
{
    case AUTO = 'auto';

    case IMPORT = 'import';
}
