<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\RequestOptions;
use Dodopayments\Responses\Webhooks\WebhookGetResponse;
use Dodopayments\Responses\Webhooks\WebhookGetSecretResponse;
use Dodopayments\Responses\Webhooks\WebhookListResponse;
use Dodopayments\Responses\Webhooks\WebhookNewResponse;
use Dodopayments\Responses\Webhooks\WebhookUpdateResponse;
use Dodopayments\WebhookEvents\WebhookEventType;

interface WebhooksContract
{
    /**
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
    ): WebhookNewResponse;

    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookGetResponse;

    /**
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
    ): WebhookUpdateResponse;

    /**
     * @param null|string $iterator The iterator returned from a prior invocation
     * @param null|int $limit Limit the number of returned items
     */
    public function list(
        $iterator = null,
        $limit = null,
        ?RequestOptions $requestOptions = null
    ): WebhookListResponse;

    public function delete(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): mixed;

    public function retrieveSecret(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookGetSecretResponse;
}
