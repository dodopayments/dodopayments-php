<?php

declare(strict_types=1);

namespace Dodopayments\Core\Services;

use Dodopayments\Client;
use Dodopayments\Core\Conversion;
use Dodopayments\Core\ServiceContracts\WebhooksContract;
use Dodopayments\Core\Services\Webhooks\HeadersService;
use Dodopayments\RequestOptions;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\Webhooks\WebhookCreateParams;
use Dodopayments\Webhooks\WebhookDetails;
use Dodopayments\Webhooks\WebhookGetSecretResponse;
use Dodopayments\Webhooks\WebhookListParams;
use Dodopayments\Webhooks\WebhookUpdateParams;

use const Dodopayments\Core\OMIT as omit;

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
     * @param string|null $description
     * @param bool|null $disabled Create the webhook in a disabled state.
     *
     * Default is false
     * @param list<WebhookEventType::*> $filterTypes Filter events to the webhook.
     *
     * Webhook event will only be sent for events in the list.
     * @param array<string, string>|null $headers Custom headers to be passed
     * @param string|null $idempotencyKey The request's idempotency key
     * @param array<string, string>|null $metadata Metadata to be passed to the webhook
     * Defaut is {}
     * @param int|null $rateLimit
     */
    public function create(
        $url,
        $description = omit,
        $disabled = omit,
        $filterTypes = omit,
        $headers = omit,
        $idempotencyKey = omit,
        $metadata = omit,
        $rateLimit = omit,
        ?RequestOptions $requestOptions = null,
    ): WebhookDetails {
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
        return Conversion::coerce(WebhookDetails::class, value: $resp);
    }

    /**
     * Get a webhook by id.
     */
    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookDetails {
        $resp = $this->client->request(
            method: 'get',
            path: ['webhooks/%1$s', $webhookID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(WebhookDetails::class, value: $resp);
    }

    /**
     * Patch a webhook by id.
     *
     * @param string|null $description Description of the webhook
     * @param bool|null $disabled to Disable the endpoint, set it to true
     * @param list<WebhookEventType::*>|null $filterTypes Filter events to the endpoint.
     *
     * Webhook event will only be sent for events in the list.
     * @param array<string, string>|null $metadata Metadata
     * @param int|null $rateLimit Rate limit
     * @param string|null $url Url endpoint
     */
    public function update(
        string $webhookID,
        $description = omit,
        $disabled = omit,
        $filterTypes = omit,
        $metadata = omit,
        $rateLimit = omit,
        $url = omit,
        ?RequestOptions $requestOptions = null,
    ): WebhookDetails {
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
        return Conversion::coerce(WebhookDetails::class, value: $resp);
    }

    /**
     * List all webhooks.
     *
     * @param string|null $iterator The iterator returned from a prior invocation
     * @param int|null $limit Limit the number of returned items
     */
    public function list(
        $iterator = omit,
        $limit = omit,
        ?RequestOptions $requestOptions = null
    ): WebhookDetails {
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
        return Conversion::coerce(WebhookDetails::class, value: $resp);
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
