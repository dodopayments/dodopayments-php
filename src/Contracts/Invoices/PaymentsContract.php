<?php

declare(strict_types=1);

namespace DodopaymentsClient\Contracts\Invoices;

use DodopaymentsClient\RequestOptions;

interface PaymentsContract
{
    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): string;
}
