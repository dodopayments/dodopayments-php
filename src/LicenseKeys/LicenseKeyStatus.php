<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys;

enum LicenseKeyStatus: string
{
    case ACTIVE = 'active';

    case EXPIRED = 'expired';

    case DISABLED = 'disabled';
}
