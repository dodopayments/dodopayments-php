<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
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

final class WebhooksService implements WebhooksContract
{
    /**
     * @api
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
     * @param array{
     *   url: string,
     *   description?: string|null,
     *   disabled?: bool|null,
     *   filter_types?: list<'payment.succeeded'|'payment.failed'|'payment.processing'|'payment.cancelled'|'refund.succeeded'|'refund.failed'|'dispute.opened'|'dispute.expired'|'dispute.accepted'|'dispute.cancelled'|'dispute.challenged'|'dispute.won'|'dispute.lost'|'subscription.active'|'subscription.renewed'|'subscription.on_hold'|'subscription.cancelled'|'subscription.failed'|'subscription.expired'|'subscription.plan_changed'|'subscription.updated'|'license_key.created'|WebhookEventType>,
     *   headers?: array<string,string>|null,
     *   idempotency_key?: string|null,
     *   metadata?: array<string,string>|null,
     *   rate_limit?: int|null,
     * }|WebhookCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|WebhookCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): WebhookDetails {
        [$parsed, $options] = WebhookCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<WebhookDetails> */
        $response = $this->client->request(
            method: 'post',
            path: 'webhooks',
            body: (object) $parsed,
            options: $options,
            convert: WebhookDetails::class,
        );

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
        /** @var BaseResponse<WebhookDetails> */
        $response = $this->client->request(
            method: 'get',
            path: ['webhooks/%1$s', $webhookID],
            options: $requestOptions,
            convert: WebhookDetails::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Patch a webhook by id
     *
     * @param array{
     *   description?: string|null,
     *   disabled?: bool|null,
     *   filter_types?: list<'payment.succeeded'|'payment.failed'|'payment.processing'|'payment.cancelled'|'refund.succeeded'|'refund.failed'|'dispute.opened'|'dispute.expired'|'dispute.accepted'|'dispute.cancelled'|'dispute.challenged'|'dispute.won'|'dispute.lost'|'subscription.active'|'subscription.renewed'|'subscription.on_hold'|'subscription.cancelled'|'subscription.failed'|'subscription.expired'|'subscription.plan_changed'|'subscription.updated'|'license_key.created'|WebhookEventType>|null,
     *   metadata?: array<string,string>|null,
     *   rate_limit?: int|null,
     *   url?: string|null,
     * }|WebhookUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        array|WebhookUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): WebhookDetails {
        [$parsed, $options] = WebhookUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<WebhookDetails> */
        $response = $this->client->request(
            method: 'patch',
            path: ['webhooks/%1$s', $webhookID],
            body: (object) $parsed,
            options: $options,
            convert: WebhookDetails::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * List all webhooks
     *
     * @param array{iterator?: string|null, limit?: int|null}|WebhookListParams $params
     *
     * @return CursorPagePagination<WebhookDetails>
     *
     * @throws APIException
     */
    public function list(
        array|WebhookListParams $params,
        ?RequestOptions $requestOptions = null
    ): CursorPagePagination {
        [$parsed, $options] = WebhookListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<CursorPagePagination<WebhookDetails>> */
        $response = $this->client->request(
            method: 'get',
            path: 'webhooks',
            query: $parsed,
            options: $options,
            convert: WebhookDetails::class,
            page: CursorPagePagination::class,
        );

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
        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'delete',
            path: ['webhooks/%1$s', $webhookID],
            options: $requestOptions,
            convert: null,
        );

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
        /** @var BaseResponse<WebhookGetSecretResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['webhooks/%1$s/secret', $webhookID],
            options: $requestOptions,
            convert: WebhookGetSecretResponse::class,
        );

        return $response->parse();
    }
}
