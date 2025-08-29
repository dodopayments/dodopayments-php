<?php

declare(strict_types=1);

namespace Dodopayments\Core\ServiceContracts\Invoices;

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
}
