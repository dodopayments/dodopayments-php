<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements\Balances\BalanceListGrantsResponse;

enum SourceType: string
{
    case SUBSCRIPTION = 'subscription';

    case ONE_TIME = 'one_time';

    case ADDON = 'addon';

    case API = 'api';

    case ROLLOVER = 'rollover';
}
