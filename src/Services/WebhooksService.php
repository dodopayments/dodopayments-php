<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\CursorPagePagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\WebhooksContract;
use Dodopayments\Services\Webhooks\HeadersService;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\Webhooks\WebhookCreateParams;
use Dodopayments\Webhooks\WebhookDetails;
use Dodopayments\Webhooks\WebhookGetSecretResponse;
use Dodopayments\Webhooks\WebhookListParams;
use Dodopayments\Webhooks\WebhookUpdateParams;

use const Dodopayments\Core\OMIT as omit;

final class WebhooksService implements WebhooksContract
{
    /**
     * @@api
     */
    public HeadersService $headers;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->headers = new HeadersService($client);
    }

    /**
     * @api
     *
     * Create a new webhook
     *
     * @param string $url Url of the webhook
     * @param string|null $description
     * @param bool|null $disabled Create the webhook in a disabled state.
     *
     * Default is false
     * @param list<WebhookEventType|value-of<WebhookEventType>> $filterTypes Filter events to the webhook.
     *
     * Webhook event will only be sent for events in the list.
     * @param array<string, string>|null $headers Custom headers to be passed
     * @param string|null $idempotencyKey The request's idempotency key
     * @param array<string, string>|null $metadata Metadata to be passed to the webhook
     * Defaut is {}
     * @param int|null $rateLimit
     *
     * @return WebhookDetails<HasRawResponse>
     *
     * @throws APIException
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
        $params = [
            'url' => $url,
            'description' => $description,
            'disabled' => $disabled,
            'filterTypes' => $filterTypes,
            'headers' => $headers,
            'idempotencyKey' => $idempotencyKey,
            'metadata' => $metadata,
            'rateLimit' => $rateLimit,
        ];

        return $this->createRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return WebhookDetails<HasRawResponse>
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): WebhookDetails {
        [$parsed, $options] = WebhookCreateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'webhooks',
            body: (object) $parsed,
            options: $options,
            convert: WebhookDetails::class,
        );
    }

    /**
     * @api
     *
     * Get a webhook by id
     *
     * @return WebhookDetails<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookDetails {
        $params = [];

        return $this->retrieveRaw($webhookID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return WebhookDetails<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $webhookID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): WebhookDetails {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['webhooks/%1$s', $webhookID],
            options: $requestOptions,
            convert: WebhookDetails::class,
        );
    }

    /**
     * @api
     *
     * Patch a webhook by id
     *
     * @param string|null $description Description of the webhook
     * @param bool|null $disabled to Disable the endpoint, set it to true
     * @param list<WebhookEventType|value-of<WebhookEventType>>|null $filterTypes Filter events to the endpoint.
     *
     * Webhook event will only be sent for events in the list.
     * @param array<string, string>|null $metadata Metadata
     * @param int|null $rateLimit Rate limit
     * @param string|null $url Url endpoint
     *
     * @return WebhookDetails<HasRawResponse>
     *
     * @throws APIException
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
        $params = [
            'description' => $description,
            'disabled' => $disabled,
            'filterTypes' => $filterTypes,
            'metadata' => $metadata,
            'rateLimit' => $rateLimit,
            'url' => $url,
        ];

        return $this->updateRaw($webhookID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return WebhookDetails<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateRaw(
        string $webhookID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): WebhookDetails {
        [$parsed, $options] = WebhookUpdateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'patch',
            path: ['webhooks/%1$s', $webhookID],
            body: (object) $parsed,
            options: $options,
            convert: WebhookDetails::class,
        );
    }

    /**
     * @api
     *
     * List all webhooks
     *
     * @param string|null $iterator The iterator returned from a prior invocation
     * @param int|null $limit Limit the number of returned items
     *
     * @return CursorPagePagination<WebhookDetails>
     *
     * @throws APIException
     */
    public function list(
        $iterator = omit,
        $limit = omit,
        ?RequestOptions $requestOptions = null
    ): CursorPagePagination {
        $params = ['iterator' => $iterator, 'limit' => $limit];

        return $this->listRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return CursorPagePagination<WebhookDetails>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): CursorPagePagination {
        [$parsed, $options] = WebhookListParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'webhooks',
            query: $parsed,
            options: $options,
            convert: WebhookDetails::class,
            page: CursorPagePagination::class,
        );
    }

    /**
     * @api
     *
     * Delete a webhook by id
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = [];

        return $this->deleteRaw($webhookID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function deleteRaw(
        string $webhookID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['webhooks/%1$s', $webhookID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get webhook secret by id
     *
     * @return WebhookGetSecretResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveSecret(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookGetSecretResponse {
        $params = [];

        return $this->retrieveSecretRaw($webhookID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return WebhookGetSecretResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveSecretRaw(
        string $webhookID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): WebhookGetSecretResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['webhooks/%1$s/secret', $webhookID],
            options: $requestOptions,
            convert: WebhookGetSecretResponse::class,
        );
    }
}
