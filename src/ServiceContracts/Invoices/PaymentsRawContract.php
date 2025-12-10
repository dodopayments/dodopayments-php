<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Invoices;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;

interface PaymentsRawContract
{
    /**
     * @api
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function retrieveRefund(
        string $refundID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
