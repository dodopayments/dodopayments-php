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

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface PaymentsRawContract
{
    /**
     * @deprecated
     *
     * @api
     *
     * @param array<string,mixed>|PaymentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaymentNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|PaymentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $paymentID Payment Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Payment>
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|PaymentListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<PaymentListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|PaymentListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $paymentID Payment Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaymentGetLineItemsResponse>
     *
     * @throws APIException
     */
    public function retrieveLineItems(
        string $paymentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
