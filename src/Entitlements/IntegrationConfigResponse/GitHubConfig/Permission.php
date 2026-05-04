<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\IntegrationConfigResponse\GitHubConfig;

/**
 * Permission to grant on the repository.
 */
enum Permission: string
{
    case PULL = 'pull';

    case PUSH = 'push';

    case ADMIN = 'admin';

    case MAINTAIN = 'maintain';

    case TRIAGE = 'triage';
}
