<?php

declare(strict_types=1);

namespace Dodopayments\Moderation;

/**
 * How a score was measured. `targeted` means a check for that one category measured it.
 * `broad` means the general check that covers all categories measured it.
 */
enum ModerationProvenance: string
{
    case TARGETED = 'targeted';

    case BROAD = 'broad';
}
