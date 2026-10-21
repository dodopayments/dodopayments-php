<?php

declare(strict_types=1);

namespace Dodopayments\Services\Invoices;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Invoices\Payments\PaymentRetrieveParams;
use Dodopayments\Invoices\Payments\PaymentRetrievePayoutParams;
use Dodopayments\Invoices\Payments\PaymentRetrieveRefundParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Invoices\PaymentsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class PaymentsRawService implements PaymentsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param string $paymentID Payment ID
     * @param array{token?: string}|PaymentRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        array|PaymentRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PaymentRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['invoices/payments/%1$s', $paymentID],
            query: $parsed,
            headers: ['Accept' => 'application/pdf'],
            options: $options,
            convert: 'string',
        );
    }

    /**
     * @api
     *
     * @param string $payoutID Payout ID
     * @param array{token?: string}|PaymentRetrievePayoutParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function retrievePayout(
        string $payoutID,
        array|PaymentRetrievePayoutParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PaymentRetrievePayoutParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['invoices/payouts/%1$s', $payoutID],
            query: $parsed,
            headers: ['Accept' => 'application/pdf'],
            options: $options,
            convert: 'string',
        );
    }

    /**
     * @api
     *
     * @param string $refundID Refund ID
     * @param array{token?: string}|PaymentRetrieveRefundParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function retrieveRefund(
        string $refundID,
        array|PaymentRetrieveRefundParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PaymentRetrieveRefundParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['invoices/refunds/%1$s', $refundID],
            query: $parsed,
            headers: ['Accept' => 'application/pdf'],
            options: $options,
            convert: 'string',
        );
    }
}
