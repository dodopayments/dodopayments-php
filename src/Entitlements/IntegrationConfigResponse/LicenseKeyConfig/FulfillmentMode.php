<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\IntegrationConfigResponse\LicenseKeyConfig;

/**
 * Fulfillment mode:
 *
 * `auto` (default) generate and delivery license keys to customers automatically.
 * `manual` creates pending grants, actual key is provided via the fulfillment
 * API and delivered to the customer when fulfilled.
 */
enum FulfillmentMode: string
{
    case AUTO = 'auto';

    case MANUAL = 'manual';
}
