<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Payouts\PayoutListParams;
use Dodopayments\Payouts\PayoutListResponse;
use Dodopayments\RequestOptions;

interface PayoutsContract
{
    /**
     * @api
     *
     * @param array<mixed>|PayoutListParams $params
     *
     * @return DefaultPageNumberPagination<PayoutListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|PayoutListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination;
}
