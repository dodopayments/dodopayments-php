<?php

declare(strict_types=1);

namespace Dodopayments\Core\Services\Invoices;

use Dodopayments\Client;
use Dodopayments\Core\ServiceContracts\Invoices\PaymentsContract;
use Dodopayments\RequestOptions;

final class PaymentsService implements PaymentsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     */
    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): string {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['invoices/payments/%1$s', $paymentID],
            headers: ['Accept' => 'application/pdf'],
            options: $requestOptions,
            convert: 'string',
        );
    }

    /**
     * @api
     */
    public function retrieveRefund(
        string $refundID,
        ?RequestOptions $requestOptions = null
    ): string {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['invoices/refunds/%1$s', $refundID],
            headers: ['Accept' => 'application/pdf'],
            options: $requestOptions,
            convert: 'string',
        );
    }
}
