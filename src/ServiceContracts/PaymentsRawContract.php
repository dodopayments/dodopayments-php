<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Payments\Payment;
use Dodopayments\Payments\PaymentCreateParams;
use Dodopayments\Payments\PaymentGetLineItemsResponse;
use Dodopayments\Payments\PaymentListParams;
use Dodopayments\Payments\PaymentListResponse;
use Dodopayments\Payments\PaymentNewResponse;
use Dodopayments\RequestOptions;

interface PaymentsRawContract
{
    /**
     * @deprecated
     *
     * @api
     *
     * @param array<mixed>|PaymentCreateParams $params
     *
     * @return BaseResponse<PaymentNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|PaymentCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $paymentID Payment Id
     *
     * @return BaseResponse<Payment>
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|PaymentListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<PaymentListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|PaymentListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $paymentID Payment Id
     *
     * @return BaseResponse<PaymentGetLineItemsResponse>
     *
     * @throws APIException
     */
    public function retrieveLineItems(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
