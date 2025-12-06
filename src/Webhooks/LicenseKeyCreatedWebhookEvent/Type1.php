<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\LicenseKeyCreatedWebhookEvent;

/**
 * The event type.
 */
enum Type1: string
{
    case LICENSE_KEY_CREATED = 'license_key.created';
}
