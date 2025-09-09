<?php

declare(strict_types=1);

namespace Dodopayments\Disputes;

enum DisputeStage: string
{
    case PRE_DISPUTE = 'pre_dispute';

    case DISPUTE = 'dispute';

    case PRE_ARBITRATION = 'pre_arbitration';
}
