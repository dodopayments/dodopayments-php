<?php

declare(strict_types=1);

namespace Dodopayments\Services\Webhooks;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Webhooks\HeadersContract;
use Dodopayments\Webhooks\Headers\HeaderGetResponse;
use Dodopayments\Webhooks\Headers\HeaderUpdateParams;

final class HeadersService implements HeadersContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get a webhook by id
     *
     * @return HeaderGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): HeaderGetResponse {
        $params = [];

        return $this->retrieveRaw($webhookID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return HeaderGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $webhookID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): HeaderGetResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['webhooks/%1$s/headers', $webhookID],
            options: $requestOptions,
            convert: HeaderGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Patch a webhook by id
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
    ): mixed {
        $params = ['headers' => $headers];

        return $this->updateRaw($webhookID, $params, $requestOptions);
    }

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
    ): mixed {
        [$parsed, $options] = HeaderUpdateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'patch',
            path: ['webhooks/%1$s/headers', $webhookID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }
}
