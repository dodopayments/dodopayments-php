<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

/**
 * The result of the 3DS authentication of a card payment, as the processor reports it.
 */
enum ThreeDSStatus: string
{
    case AUTHENTICATED = 'authenticated';

    case ATTEMPT_ACKNOWLEDGED = 'attempt_acknowledged';

    case EXEMPTED = 'exempted';

    case FAILED = 'failed';

    case NOT_SUPPORTED = 'not_supported';

    case PROCESSING_ERROR = 'processing_error';
}
