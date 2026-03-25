<?php

declare(strict_types=1);

namespace Dodopayments\Services\Invoices;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        RequestOptions|array|null $requestOptions = null
    ): string {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($paymentID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveRefund(
        string $refundID,
        RequestOptions|array|null $requestOptions = null
    ): string {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveRefund($refundID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
