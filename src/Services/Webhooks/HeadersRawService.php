<?php

declare(strict_types=1);

namespace Dodopayments\Services\Webhooks;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Webhooks\HeadersRawContract;
use Dodopayments\Webhooks\Headers\HeaderGetResponse;
use Dodopayments\Webhooks\Headers\HeaderUpdateParams;

final class HeadersRawService implements HeadersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get a webhook by id
     *
     * @return BaseResponse<HeaderGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
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
     * @param array{headers: array<string,string>}|HeaderUpdateParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        array|HeaderUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = HeaderUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['webhooks/%1$s/headers', $webhookID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }
}
