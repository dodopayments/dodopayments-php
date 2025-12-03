<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Payments\Payment;
use Dodopayments\Payments\PaymentCreateParams;
use Dodopayments\Payments\PaymentGetLineItemsResponse;
use Dodopayments\Payments\PaymentListParams;
use Dodopayments\Payments\PaymentListResponse;
use Dodopayments\Payments\PaymentNewResponse;
use Dodopayments\RequestOptions;

interface PaymentsContract
{
    /**
     * @api
     *
     * @param array<mixed>|PaymentCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|PaymentCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): PaymentNewResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): Payment;

    /**
     * @api
     *
     * @param array<mixed>|PaymentListParams $params
     *
     * @return DefaultPageNumberPagination<PaymentListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|PaymentListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveLineItems(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): PaymentGetLineItemsResponse;
}
