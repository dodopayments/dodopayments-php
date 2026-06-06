<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\IntegrationConfig\LicenseKeyConfig;

/**
 * Fulfillment mode: `auto` (default) generates keys automatically; `manual`
 * creates pending grants the merchant fulfills via the `POST /grants/{id}/license-key` endpoint.
 */
enum FulfillmentMode: string
{
    case AUTO = 'auto';

    case MANUAL = 'manual';
}
