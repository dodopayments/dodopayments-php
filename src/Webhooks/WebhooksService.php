<?php

declare(strict_types=1);

namespace DodopaymentsClient\Webhooks;

use DodopaymentsClient\Client;
use DodopaymentsClient\Contracts\WebhooksContract;
use DodopaymentsClient\Core\Conversion;
use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\Responses\Webhooks\WebhookGetResponse;
use DodopaymentsClient\Responses\Webhooks\WebhookListResponse;
use DodopaymentsClient\Responses\Webhooks\WebhookNewResponse;
use DodopaymentsClient\Responses\Webhooks\WebhookUpdateResponse;
use DodopaymentsClient\WebhookEvents\WebhookEventType;
use DodopaymentsClient\Webhooks\Headers\HeadersService;

final class WebhooksService implements WebhooksContract
{
    public HeadersService $headers;

    public function __construct(private Client $client)
    {
        $this->headers = new HeadersService($this->client);
    }

    /**
     * Create a new webhook.
     *
     * @param array{
     *   url: string,
     *   description?: null|string,
     *   disabled?: null|bool,
     *   filterTypes?: list<WebhookEventType::*>,
     *   headers?: null|array<string, string>,
     *   idempotencyKey?: null|string,
     *   metadata?: null|array<string, string>,
     *   rateLimit?: null|int,
     * }|WebhookCreateParams $params
     */
    public function create(
        array|WebhookCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): WebhookNewResponse {
        [$parsed, $options] = WebhookCreateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'webhooks',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(WebhookNewResponse::class, value: $resp);
    }

    /**
     * Get a webhook by id.
     */
    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookGetResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['webhooks/%1$s', $webhookID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(WebhookGetResponse::class, value: $resp);
    }

    /**
     * Patch a webhook by id.
     *
     * @param array{
     *   description?: null|string,
     *   disabled?: null|bool,
     *   filterTypes?: null|list<WebhookEventType::*>,
     *   metadata?: null|array<string, string>,
     *   rateLimit?: null|int,
     *   url?: null|string,
     * }|WebhookUpdateParams $params
     */
    public function update(
        string $webhookID,
        array|WebhookUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): WebhookUpdateResponse {
        [$parsed, $options] = WebhookUpdateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'patch',
            path: ['webhooks/%1$s', $webhookID],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(WebhookUpdateResponse::class, value: $resp);
    }

    /**
     * List all webhooks.
     *
     * @param array{iterator?: null|string, limit?: null|int}|WebhookListParams $params
     */
    public function list(
        array|WebhookListParams $params,
        ?RequestOptions $requestOptions = null
    ): WebhookListResponse {
        [$parsed, $options] = WebhookListParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'webhooks',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(WebhookListResponse::class, value: $resp);
    }

    /**
     * Delete a webhook by id.
     */
    public function delete(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        return $this->client->request(
            method: 'delete',
            path: ['webhooks/%1$s', $webhookID],
            options: $requestOptions,
        );
    }
}
