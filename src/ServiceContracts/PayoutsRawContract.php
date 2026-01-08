<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Payouts\PayoutListParams;
use Dodopayments\Payouts\PayoutListResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface PayoutsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|PayoutListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<PayoutListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|PayoutListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
