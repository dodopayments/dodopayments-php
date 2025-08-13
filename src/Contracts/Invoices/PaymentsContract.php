<?php

declare(strict_types=1);

namespace DodoPayments\Contracts\Invoices;

use DodoPayments\RequestOptions;

interface PaymentsContract
{
    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): string;
}
