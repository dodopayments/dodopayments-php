<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Webhooks;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;
use Dodopayments\Webhooks\Headers\HeaderGetResponse;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface HeadersContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): HeaderGetResponse;

    /**
     * @api
     *
     * @param array<string,string> $headers Object of header-value pair to update or add
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        array $headers,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
