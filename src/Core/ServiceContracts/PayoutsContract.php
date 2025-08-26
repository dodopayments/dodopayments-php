<?php

declare(strict_types=1);

namespace Dodopayments\Core\ServiceContracts;

use Dodopayments\Payouts\PayoutListResponse;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

interface PayoutsContract
{
    /**
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     */
    public function list(
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null,
    ): PayoutListResponse;
}
