<?php

declare(strict_types=1);

namespace Dodopayments\Services\Invoices;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Invoices\PaymentsContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class PaymentsService implements PaymentsContract
{
    /**
     * @api
     */
    public PaymentsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PaymentsRawService($client);
    }

    /**
     * @api
     *
     * @param string $paymentID Payment ID
     * @param string $token The signed link token. If the business asks for a credential on its invoice links, a valid token for this record replaces the credential.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        ?string $token = null,
        RequestOptions|array|null $requestOptions = null,
    ): string {
        $params = Util::removeNulls(['token' => $token]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($paymentID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $payoutID Payout ID
     * @param string $token The signed link token. If the business asks for a credential on its invoice links, a valid token for this record replaces the credential.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrievePayout(
        string $payoutID,
        ?string $token = null,
        RequestOptions|array|null $requestOptions = null,
    ): string {
        $params = Util::removeNulls(['token' => $token]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrievePayout($payoutID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $refundID Refund ID
     * @param string $token The signed link token. If the business asks for a credential on its invoice links, a valid token for this record replaces the credential.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveRefund(
        string $refundID,
        ?string $token = null,
        RequestOptions|array|null $requestOptions = null,
    ): string {
        $params = Util::removeNulls(['token' => $token]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveRefund($refundID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
