<?php

declare(strict_types=1);

namespace Dodopayments\Payments\Payment\FailureDetails;

/**
 * Soft or hard decline.
 */
enum DeclineType: string
{
    case SOFT = 'soft';

    case HARD = 'hard';
}
