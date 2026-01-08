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

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface RefundsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|RefundCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Refund>
     *
     * @throws APIException
     */
    public function create(
        array|RefundCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $refundID Refund Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Refund>
     *
     * @throws APIException
     */
    public function retrieve(
        string $refundID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|RefundListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<RefundListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|RefundListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
