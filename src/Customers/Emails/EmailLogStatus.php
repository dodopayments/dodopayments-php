<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Emails;

/**
 * The delivery status of one email.
 *
 * `sent` also covers an email that is still on its way. A status only becomes
 * `delivered`, `failed` or `complained` when the mail server answers.
 */
enum EmailLogStatus: string
{
    case SENT = 'sent';

    case DELIVERED = 'delivered';

    case FAILED = 'failed';

    case COMPLAINED = 'complained';

    case BLOCKED = 'blocked';
}
