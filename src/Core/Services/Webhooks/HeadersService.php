<?php

declare(strict_types=1);

namespace Dodopayments\Core\Services\Webhooks;

use Dodopayments\Client;
use Dodopayments\Core\Conversion;
use Dodopayments\Core\ServiceContracts\Webhooks\HeadersContract;
use Dodopayments\RequestOptions;
use Dodopayments\Webhooks\Headers\HeaderGetResponse;
use Dodopayments\Webhooks\Headers\HeaderUpdateParams;

final class HeadersService implements HeadersContract
{
    public function __construct(private Client $client) {}

    /**
     * Get a webhook by id.
     */
    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): HeaderGetResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['webhooks/%1$s/headers', $webhookID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(HeaderGetResponse::class, value: $resp);
    }

    /**
     * Patch a webhook by id.
     *
     * @param array<string,
     * string,> $headers Object of header-value pair to update or add
     */
    public function update(
        string $webhookID,
        $headers,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = HeaderUpdateParams::parseRequest(
            ['headers' => $headers],
            $requestOptions
        );

        return $this->client->request(
            method: 'patch',
            path: ['webhooks/%1$s/headers', $webhookID],
            body: (object) $parsed,
            options: $options,
        );
    }
}
