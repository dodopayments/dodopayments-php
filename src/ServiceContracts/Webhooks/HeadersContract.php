<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Webhooks;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;
use Dodopayments\Webhooks\Headers\HeaderGetResponse;

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
     * @param array<string,
     * string,> $headers Object of header-value pair to update or add
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        $headers,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $webhookID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
