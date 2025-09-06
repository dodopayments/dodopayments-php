<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Invoices;

use Dodopayments\RequestOptions;

interface PaymentsContract
{
    /**
     * @api
     */
    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): string;

    /**
     * @api
     */
    public function retrieveRefund(
        string $refundID,
        ?RequestOptions $requestOptions = null
    ): string;
}
