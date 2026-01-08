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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        RequestOptions|array|null $requestOptions = null
    ): string;

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
    ): string;
}
