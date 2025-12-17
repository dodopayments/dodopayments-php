<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams;
use Dodopayments\CheckoutSessions\CheckoutSessionResponse;
use Dodopayments\CheckoutSessions\CheckoutSessionStatus;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;

interface CheckoutSessionsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CheckoutSessionCreateParams $params
     *
     * @return BaseResponse<CheckoutSessionResponse>
     *
     * @throws APIException
     */
    public function create(
        array|CheckoutSessionCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<CheckoutSessionStatus>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
