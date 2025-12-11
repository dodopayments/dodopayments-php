<?php

declare(strict_types=1);

namespace Dodopayments\Services\Webhooks;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Webhooks\HeadersContract;
use Dodopayments\Webhooks\Headers\HeaderGetResponse;

final class HeadersService implements HeadersContract
{
    /**
     * @api
     */
    public HeadersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new HeadersRawService($client);
    }

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
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($webhookID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Patch a webhook by id
     *
     * @param array<string,string> $headers Object of header-value pair to update or add
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        array $headers,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = Util::removeNulls(['headers' => $headers]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($webhookID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
