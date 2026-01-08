<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams;
use Dodopayments\CheckoutSessions\CheckoutSessionResponse;
use Dodopayments\CheckoutSessions\CheckoutSessionStatus;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface CheckoutSessionsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CheckoutSessionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckoutSessionResponse>
     *
     * @throws APIException
     */
    public function create(
        array|CheckoutSessionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckoutSessionStatus>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
