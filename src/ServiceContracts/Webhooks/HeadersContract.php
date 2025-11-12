<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Webhooks;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;
use Dodopayments\Webhooks\Headers\HeaderGetResponse;
use Dodopayments\Webhooks\Headers\HeaderUpdateParams;

interface HeadersContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): HeaderGetResponse;

    /**
     * @api
     *
     * @param array<mixed>|HeaderUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        array|HeaderUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
