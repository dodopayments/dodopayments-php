<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\RequestOptions;
use Dodopayments\Responses\Webhooks\WebhookGetResponse;
use Dodopayments\Responses\Webhooks\WebhookListResponse;
use Dodopayments\Responses\Webhooks\WebhookNewResponse;
use Dodopayments\Responses\Webhooks\WebhookUpdateResponse;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\Webhooks\WebhookCreateParams;
use Dodopayments\Webhooks\WebhookListParams;
use Dodopayments\Webhooks\WebhookUpdateParams;

interface WebhooksContract
{
    /**
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
        ?RequestOptions $requestOptions = null,
    ): WebhookNewResponse;

    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookGetResponse;

    /**
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
    ): WebhookUpdateResponse;

    /**
     * @param array{iterator?: null|string, limit?: null|int}|WebhookListParams $params
     */
    public function list(
        array|WebhookListParams $params,
        ?RequestOptions $requestOptions = null
    ): WebhookListResponse;

    public function delete(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
