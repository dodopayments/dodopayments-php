<?php

declare(strict_types=1);

namespace DodoPayments\Contracts;

use DodoPayments\Payouts\PayoutListParams;
use DodoPayments\RequestOptions;
use DodoPayments\Responses\Payouts\PayoutListResponse;

interface PayoutsContract
{
    /**
     * @param array{pageNumber?: int, pageSize?: int}|PayoutListParams $params
     */
    public function list(
        array|PayoutListParams $params,
        ?RequestOptions $requestOptions = null
    ): PayoutListResponse;
}
