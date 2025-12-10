<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\CursorPagePagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\WebhooksContract;
use Dodopayments\Services\Webhooks\HeadersService;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\Webhooks\WebhookDetails;
use Dodopayments\Webhooks\WebhookGetSecretResponse;

final class WebhooksService implements WebhooksContract
{
    /**
     * @api
     */
    public WebhooksRawService $raw;

    /**
     * @api
     */
    public HeadersService $headers;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WebhooksRawService($client);
        $this->headers = new HeadersService($client);
    }

    /**
     * @api
     *
     * Create a new webhook
     *
     * @param string $url Url of the webhook
     * @param bool|null $disabled Create the webhook in a disabled state.
     *
     * Default is false
     * @param list<'payment.succeeded'|'payment.failed'|'payment.processing'|'payment.cancelled'|'refund.succeeded'|'refund.failed'|'dispute.opened'|'dispute.expired'|'dispute.accepted'|'dispute.cancelled'|'dispute.challenged'|'dispute.won'|'dispute.lost'|'subscription.active'|'subscription.renewed'|'subscription.on_hold'|'subscription.cancelled'|'subscription.failed'|'subscription.expired'|'subscription.plan_changed'|'subscription.updated'|'license_key.created'|WebhookEventType> $filterTypes Filter events to the webhook.
     *
     * Webhook event will only be sent for events in the list.
     * @param array<string,string>|null $headers Custom headers to be passed
     * @param string|null $idempotencyKey The request's idempotency key
     * @param array<string,string>|null $metadata Metadata to be passed to the webhook
     * Defaut is {}
     *
     * @throws APIException
     */
    public function create(
        string $url,
        ?string $description = null,
        ?bool $disabled = null,
        ?array $filterTypes = null,
        ?array $headers = null,
        ?string $idempotencyKey = null,
        ?array $metadata = null,
        ?int $rateLimit = null,
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
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
    ): WebhookDetails {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($webhookID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Patch a webhook by id
     *
     * @param string|null $description Description of the webhook
     * @param bool|null $disabled to Disable the endpoint, set it to true
     * @param list<'payment.succeeded'|'payment.failed'|'payment.processing'|'payment.cancelled'|'refund.succeeded'|'refund.failed'|'dispute.opened'|'dispute.expired'|'dispute.accepted'|'dispute.cancelled'|'dispute.challenged'|'dispute.won'|'dispute.lost'|'subscription.active'|'subscription.renewed'|'subscription.on_hold'|'subscription.cancelled'|'subscription.failed'|'subscription.expired'|'subscription.plan_changed'|'subscription.updated'|'license_key.created'|WebhookEventType>|null $filterTypes Filter events to the endpoint.
     *
     * Webhook event will only be sent for events in the list.
     * @param array<string,string>|null $metadata Metadata
     * @param int|null $rateLimit Rate limit
     * @param string|null $url Url endpoint
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        ?string $description = null,
        ?bool $disabled = null,
        ?array $filterTypes = null,
        ?array $metadata = null,
        ?int $rateLimit = null,
        ?string $url = null,
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
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($webhookID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
        ?string $iterator = null,
        ?int $limit = null,
        ?RequestOptions $requestOptions = null,
    ): CursorPagePagination {
        $params = ['iterator' => $iterator, 'limit' => $limit];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($webhookID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get webhook secret by id
     *
     * @throws APIException
     */
    public function retrieveSecret(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookGetSecretResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveSecret($webhookID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
