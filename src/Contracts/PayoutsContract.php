<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\Payouts\PayoutListParams;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Payouts\PayoutListResponse;

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
