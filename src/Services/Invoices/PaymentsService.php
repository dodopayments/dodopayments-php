<?php

declare(strict_types=1);

namespace Dodopayments\Services\Invoices;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Invoices\PaymentsContract;

final class PaymentsService implements PaymentsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): string {
        $params = [];

        return $this->retrieveRaw($paymentID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $paymentID,
        mixed $params,
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
     *
     * @throws APIException
     */
    public function retrieveRefund(
        string $refundID,
        ?RequestOptions $requestOptions = null
    ): string {
        $params = [];

        return $this->retrieveRefundRaw($refundID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveRefundRaw(
        string $refundID,
        mixed $params,
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
