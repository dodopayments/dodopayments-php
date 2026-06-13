<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\IntegrationConfigResponse\LicenseKeyConfig;

/**
 * How license keys are fulfilled. `auto` (default) generates and delivers
 * keys to customers automatically; `manual` creates pending grants that you
 * fulfill with the supplied key via `POST /grants/{grant_id}/license-key`.
 */
enum FulfillmentMode: string
{
    case AUTO = 'auto';

    case MANUAL = 'manual';
}
