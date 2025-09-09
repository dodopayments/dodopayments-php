<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data\LicenseKey;

enum PayloadType: string
{
    case LICENSE_KEY = 'LicenseKey';
}
