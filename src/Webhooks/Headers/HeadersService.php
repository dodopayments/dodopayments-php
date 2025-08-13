<?php

declare(strict_types=1);

namespace DodopaymentsClient\Webhooks\Headers;

use DodopaymentsClient\Client;
use DodopaymentsClient\Contracts\Webhooks\HeadersContract;
use DodopaymentsClient\Core\Conversion;
use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\Responses\Webhooks\Headers\HeaderGetResponse;

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
     * @param array{headers: array<string, string>}|HeaderUpdateParams $params
     */
    public function update(
        string $webhookID,
        array|HeaderUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = HeaderUpdateParams::parseRequest(
            $params,
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
