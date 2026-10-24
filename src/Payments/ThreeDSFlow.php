<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

/**
 * How the cardholder completed the 3DS authentication.
 */
enum ThreeDSFlow: string
{
    case CHALLENGE = 'challenge';

    case FRICTIONLESS = 'frictionless';
}
