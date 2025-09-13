<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Invoices;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;

interface PaymentsContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): string;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $paymentID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): string;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveRefund(
        string $refundID,
        ?RequestOptions $requestOptions = null
    ): string;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveRefundRaw(
        string $refundID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): string;
}
