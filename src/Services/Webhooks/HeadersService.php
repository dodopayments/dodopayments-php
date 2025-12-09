<?php

declare(strict_types=1);

namespace Dodopayments\Services\Webhooks;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
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
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): HeaderGetResponse {
        /** @var BaseResponse<HeaderGetResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['webhooks/%1$s/headers', $webhookID],
            options: $requestOptions,
            convert: HeaderGetResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Patch a webhook by id
     *
     * @param array{headers: array<string,string>}|HeaderUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        array|HeaderUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = HeaderUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'patch',
            path: ['webhooks/%1$s/headers', $webhookID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );

        return $response->parse();
    }
}
