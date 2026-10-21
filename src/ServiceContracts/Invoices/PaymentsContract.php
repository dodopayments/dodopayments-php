<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Invoices;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface PaymentsContract
{
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
    ): string;

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
    ): string;

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
    ): string;
}
