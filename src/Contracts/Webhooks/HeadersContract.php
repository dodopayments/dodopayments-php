<?php

declare(strict_types=1);

namespace DodoPayments\Contracts\Webhooks;

use DodoPayments\RequestOptions;
use DodoPayments\Responses\Webhooks\Headers\HeaderGetResponse;
use DodoPayments\Webhooks\Headers\HeaderUpdateParams;

interface HeadersContract
{
    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): HeaderGetResponse;

    /**
     * @param array{headers: array<string, string>}|HeaderUpdateParams $params
     */
    public function update(
        string $webhookID,
        array|HeaderUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
