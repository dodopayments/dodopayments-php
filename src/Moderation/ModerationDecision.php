<?php

declare(strict_types=1);

namespace Dodopayments\Moderation;

/**
 * The verdict. `allow` means the content passed. `deny` means block the content. `flag` means
 * apply your own judgement. It is not a soft deny.
 */
enum ModerationDecision: string
{
    case ALLOW = 'allow';

    case FLAG = 'flag';

    case DENY = 'deny';
}
