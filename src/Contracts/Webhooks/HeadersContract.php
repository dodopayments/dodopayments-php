<?php

declare(strict_types=1);

namespace Dodopayments\Contracts\Webhooks;

use Dodopayments\RequestOptions;
use Dodopayments\Responses\Webhooks\Headers\HeaderGetResponse;
use Dodopayments\Webhooks\Headers\HeaderUpdateParams;

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
