<?php

declare(strict_types=1);

namespace Dodopayments\Disputes;

enum DisputeStatus: string
{
    case DISPUTE_OPENED = 'dispute_opened';

    case DISPUTE_EXPIRED = 'dispute_expired';

    case DISPUTE_ACCEPTED = 'dispute_accepted';

    case DISPUTE_CANCELLED = 'dispute_cancelled';

    case DISPUTE_CHALLENGED = 'dispute_challenged';

    case DISPUTE_WON = 'dispute_won';

    case DISPUTE_LOST = 'dispute_lost';
}
