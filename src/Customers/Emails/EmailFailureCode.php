<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Emails;

/**
 * Why an email did not reach the recipient.
 *
 * The code is stable. `send_failed` is the catch-all: it covers every failure
 * that the other codes do not name.
 */
enum EmailFailureCode: string
{
    case MAILBOX_NOT_FOUND = 'mailbox_not_found';

    case ADDRESS_REJECTED = 'address_rejected';

    case ADDRESS_SUPPRESSED = 'address_suppressed';

    case MAILBOX_FULL = 'mailbox_full';

    case TEMPORARY_FAILURE = 'temporary_failure';

    case MESSAGE_TOO_LARGE = 'message_too_large';

    case MARKED_AS_SPAM = 'marked_as_spam';

    case SEND_FAILED = 'send_failed';
}
