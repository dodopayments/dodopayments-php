<?php

declare(strict_types=1);

namespace Dodopayments\Services\Invoices;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
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
        /** @var BaseResponse<string> */
        $response = $this->client->request(
            method: 'get',
            path: ['invoices/payments/%1$s', $paymentID],
            headers: ['Accept' => 'application/pdf'],
            options: $requestOptions,
            convert: 'string',
        );

        return $response->parse();
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
        /** @var BaseResponse<string> */
        $response = $this->client->request(
            method: 'get',
            path: ['invoices/refunds/%1$s', $refundID],
            headers: ['Accept' => 'application/pdf'],
            options: $requestOptions,
            convert: 'string',
        );

        return $response->parse();
    }
}
