<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\LicenseKeyCreatedWebhookEvent\Data;

/**
 * The type of payload in the data field.
 */
enum PayloadType: string
{
    case LICENSE_KEY = 'LicenseKey';
}
