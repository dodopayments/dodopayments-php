<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements;

/**
 * Repository permission to grant on a `github` entitlement.
 */
enum GitHubPermission: string
{
    case PULL = 'pull';

    case PUSH = 'push';

    case ADMIN = 'admin';

    case MAINTAIN = 'maintain';

    case TRIAGE = 'triage';
}
