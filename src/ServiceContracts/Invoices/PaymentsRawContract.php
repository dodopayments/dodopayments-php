<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Invoices;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Invoices\Payments\PaymentRetrieveParams;
use Dodopayments\Invoices\Payments\PaymentRetrievePayoutParams;
use Dodopayments\Invoices\Payments\PaymentRetrieveRefundParams;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface PaymentsRawContract
{
    /**
     * @api
     *
     * @param string $paymentID Payment ID
     * @param array<string,mixed>|PaymentRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        array|PaymentRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $payoutID Payout ID
     * @param array<string,mixed>|PaymentRetrievePayoutParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function retrievePayout(
        string $payoutID,
        array|PaymentRetrievePayoutParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $refundID Refund ID
     * @param array<string,mixed>|PaymentRetrieveRefundParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function retrieveRefund(
        string $refundID,
        array|PaymentRetrieveRefundParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
