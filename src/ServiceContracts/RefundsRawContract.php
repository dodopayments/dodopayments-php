<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Refunds\Refund;
use Dodopayments\Refunds\RefundCreateParams;
use Dodopayments\Refunds\RefundListParams;
use Dodopayments\Refunds\RefundListResponse;
use Dodopayments\RequestOptions;

interface RefundsRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|RefundCreateParams $params
     *
     * @return BaseResponse<Refund>
     *
     * @throws APIException
     */
    public function create(
        array|RefundCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $refundID Refund Id
     *
     * @return BaseResponse<Refund>
     *
     * @throws APIException
     */
    public function retrieve(
        string $refundID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|RefundListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<RefundListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|RefundListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
