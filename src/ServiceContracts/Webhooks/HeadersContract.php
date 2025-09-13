<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Webhooks;

use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\RequestOptions;
use Dodopayments\Webhooks\Headers\HeaderGetResponse;

interface HeadersContract
{
    /**
     * @api
     *
     * @return HeaderGetResponse<HasRawResponse>
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
     */
    public function update(
        string $webhookID,
        $headers,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
