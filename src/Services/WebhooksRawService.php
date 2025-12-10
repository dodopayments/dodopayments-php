<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\CursorPagePagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\WebhooksRawContract;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\Webhooks\WebhookCreateParams;
use Dodopayments\Webhooks\WebhookDetails;
use Dodopayments\Webhooks\WebhookGetSecretResponse;
use Dodopayments\Webhooks\WebhookListParams;
use Dodopayments\Webhooks\WebhookUpdateParams;

final class WebhooksRawService implements WebhooksRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new webhook
     *
     * @param array{
     *   url: string,
     *   description?: string|null,
     *   disabled?: bool|null,
     *   filterTypes?: list<'payment.succeeded'|'payment.failed'|'payment.processing'|'payment.cancelled'|'refund.succeeded'|'refund.failed'|'dispute.opened'|'dispute.expired'|'dispute.accepted'|'dispute.cancelled'|'dispute.challenged'|'dispute.won'|'dispute.lost'|'subscription.active'|'subscription.renewed'|'subscription.on_hold'|'subscription.cancelled'|'subscription.failed'|'subscription.expired'|'subscription.plan_changed'|'subscription.updated'|'license_key.created'|WebhookEventType>,
     *   headers?: array<string,string>|null,
     *   idempotencyKey?: string|null,
     *   metadata?: array<string,string>|null,
     *   rateLimit?: int|null,
     * }|WebhookCreateParams $params
     *
     * @return BaseResponse<WebhookDetails>
     *
     * @throws APIException
     */
    public function create(
        array|WebhookCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = WebhookCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
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
     * @return BaseResponse<WebhookDetails>
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
     * @param array{
     *   description?: string|null,
     *   disabled?: bool|null,
     *   filterTypes?: list<'payment.succeeded'|'payment.failed'|'payment.processing'|'payment.cancelled'|'refund.succeeded'|'refund.failed'|'dispute.opened'|'dispute.expired'|'dispute.accepted'|'dispute.cancelled'|'dispute.challenged'|'dispute.won'|'dispute.lost'|'subscription.active'|'subscription.renewed'|'subscription.on_hold'|'subscription.cancelled'|'subscription.failed'|'subscription.expired'|'subscription.plan_changed'|'subscription.updated'|'license_key.created'|WebhookEventType>|null,
     *   metadata?: array<string,string>|null,
     *   rateLimit?: int|null,
     *   url?: string|null,
     * }|WebhookUpdateParams $params
     *
     * @return BaseResponse<WebhookDetails>
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        array|WebhookUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebhookUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
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
     * @param array{iterator?: string|null, limit?: int|null}|WebhookListParams $params
     *
     * @return BaseResponse<CursorPagePagination<WebhookDetails>>
     *
     * @throws APIException
     */
    public function list(
        array|WebhookListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = WebhookListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
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
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
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
     * @return BaseResponse<WebhookGetSecretResponse>
     *
     * @throws APIException
     */
    public function retrieveSecret(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['webhooks/%1$s/secret', $webhookID],
            options: $requestOptions,
            convert: WebhookGetSecretResponse::class,
        );
    }
}
