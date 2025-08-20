<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\RequestOptions;
use Dodopayments\Responses\Payouts\PayoutListResponse;

interface PayoutsContract
{
    /**
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     */
    public function list(
        $pageNumber = null,
        $pageSize = null,
        ?RequestOptions $requestOptions = null,
    ): PayoutListResponse;
}
