<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams;
use Dodopayments\CheckoutSessions\CheckoutSessionResponse;
use Dodopayments\CheckoutSessions\CheckoutSessionStatus;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;

interface CheckoutSessionsContract
{
    /**
     * @api
     *
     * @param array<mixed>|CheckoutSessionCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|CheckoutSessionCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CheckoutSessionResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): CheckoutSessionStatus;
}
