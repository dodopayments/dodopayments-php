<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Client;
use Dodopayments\Contracts\WebhooksContract;
use Dodopayments\Core\Conversion;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Webhooks\WebhookGetResponse;
use Dodopayments\Responses\Webhooks\WebhookGetSecretResponse;
use Dodopayments\Responses\Webhooks\WebhookListResponse;
use Dodopayments\Responses\Webhooks\WebhookNewResponse;
use Dodopayments\Responses\Webhooks\WebhookUpdateResponse;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\Webhooks\Headers\HeadersService;

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
     * @param string $url Url of the webhook
     * @param null|string $description
     * @param null|bool $disabled Create the webhook in a disabled state.
     *
     * Default is false
     * @param list<WebhookEventType::*> $filterTypes Filter events to the webhook.
     *
     * Webhook event will only be sent for events in the list.
     * @param null|array<string, string> $headers Custom headers to be passed
     * @param null|string $idempotencyKey The request's idempotency key
     * @param null|array<string, string> $metadata Metadata to be passed to the webhook
     * Defaut is {}
     * @param null|int $rateLimit
     */
    public function create(
        $url,
        $description = null,
        $disabled = null,
        $filterTypes = null,
        $headers = null,
        $idempotencyKey = null,
        $metadata = null,
        $rateLimit = null,
        ?RequestOptions $requestOptions = null,
    ): WebhookNewResponse {
        [$parsed, $options] = WebhookCreateParams::parseRequest(
            [
                'url' => $url,
                'description' => $description,
                'disabled' => $disabled,
                'filterTypes' => $filterTypes,
                'headers' => $headers,
                'idempotencyKey' => $idempotencyKey,
                'metadata' => $metadata,
                'rateLimit' => $rateLimit,
            ],
            $requestOptions,
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
     * @param null|string $description Description of the webhook
     * @param null|bool $disabled to Disable the endpoint, set it to true
     * @param null|list<WebhookEventType::*> $filterTypes Filter events to the endpoint.
     *
     * Webhook event will only be sent for events in the list.
     * @param null|array<string, string> $metadata Metadata
     * @param null|int $rateLimit Rate limit
     * @param null|string $url Url endpoint
     */
    public function update(
        string $webhookID,
        $description = null,
        $disabled = null,
        $filterTypes = null,
        $metadata = null,
        $rateLimit = null,
        $url = null,
        ?RequestOptions $requestOptions = null,
    ): WebhookUpdateResponse {
        [$parsed, $options] = WebhookUpdateParams::parseRequest(
            [
                'description' => $description,
                'disabled' => $disabled,
                'filterTypes' => $filterTypes,
                'metadata' => $metadata,
                'rateLimit' => $rateLimit,
                'url' => $url,
            ],
            $requestOptions,
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
     * @param null|string $iterator The iterator returned from a prior invocation
     * @param null|int $limit Limit the number of returned items
     */
    public function list(
        $iterator = null,
        $limit = null,
        ?RequestOptions $requestOptions = null
    ): WebhookListResponse {
        [$parsed, $options] = WebhookListParams::parseRequest(
            ['iterator' => $iterator, 'limit' => $limit],
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

    /**
     * Get webhook secret by id.
     */
    public function retrieveSecret(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookGetSecretResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['webhooks/%1$s/secret', $webhookID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(WebhookGetSecretResponse::class, value: $resp);
    }
}
