<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Refunds\Refund;
use Dodopayments\Refunds\RefundCreateParams;
use Dodopayments\Refunds\RefundListParams;
use Dodopayments\Refunds\RefundListResponse;
use Dodopayments\RequestOptions;

interface RefundsContract
{
    /**
     * @api
     *
     * @param array<mixed>|RefundCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|RefundCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): Refund;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $refundID,
        ?RequestOptions $requestOptions = null
    ): Refund;

    /**
     * @api
     *
     * @param array<mixed>|RefundListParams $params
     *
     * @return DefaultPageNumberPagination<RefundListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|RefundListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination;
}
