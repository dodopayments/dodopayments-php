<?php

declare(strict_types=1);

namespace DodoPayments\Invoices\Payments;

use DodoPayments\Client;
use DodoPayments\Contracts\Invoices\PaymentsContract;
use DodoPayments\Core\Conversion;
use DodoPayments\RequestOptions;

final class PaymentsService implements PaymentsContract
{
    public function __construct(private Client $client) {}

    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): string {
        $resp = $this->client->request(
            method: 'get',
            path: ['invoices/payments/%1$s', $paymentID],
            headers: ['Accept' => 'application/pdf'],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce('string', value: $resp);
    }
}
