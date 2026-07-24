<?php

declare(strict_types=1);

namespace Dodopayments\Payments\Payment\FailureDetails;

/**
 * The primary CTA to show the customer.
 */
enum CustomerCta: string
{
    case EDIT_AND_RETRY = 'edit_and_retry';

    case USE_ANOTHER_METHOD = 'use_another_method';

    case TRY_AGAIN = 'try_again';

    case TRY_LATER = 'try_later';

    case RETRY_AND_VERIFY = 'retry_and_verify';

    case RESTART = 'restart';

    case UPDATE_METHOD = 'update_method';
}
