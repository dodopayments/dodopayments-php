<?php

declare(strict_types=1);

namespace Dodopayments\Core\ServiceContracts\Webhooks;

use Dodopayments\RequestOptions;
use Dodopayments\Webhooks\Headers\HeaderGetResponse;

interface HeadersContract
{
    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): HeaderGetResponse;

    /**
     * @param array<string,
     * string,> $headers Object of header-value pair to update or add
     */
    public function update(
        string $webhookID,
        $headers,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
