<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Payouts\Breakup;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Payouts\Breakup\Details\DetailListParams;
use Dodopayments\Payouts\Breakup\Details\DetailListResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface DetailsRawContract
{
    /**
     * @api
     *
     * @param string $payoutID Id of the Payout to get breakup for
     * @param array<string,mixed>|DetailListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<DetailListResponse>>
     *
     * @throws APIException
     */
    public function list(
        string $payoutID,
        array|DetailListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $payoutID Id of the Payout to get breakup for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function downloadCsv(
        string $payoutID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
