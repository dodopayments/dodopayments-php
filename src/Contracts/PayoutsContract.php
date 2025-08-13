<?php

declare(strict_types=1);

namespace DodopaymentsClient\Contracts;

use DodopaymentsClient\Payouts\PayoutListParams;
use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\Responses\Payouts\PayoutListResponse;

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
