<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Invoices;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface PaymentsRawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function retrieveRefund(
        string $refundID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
