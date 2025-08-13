<?php

declare(strict_types=1);

namespace Dodopayments\Contracts\Invoices;

use Dodopayments\RequestOptions;

interface PaymentsContract
{
    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): string;
}
