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
        $description = null,
        $disabled = null,
        $filterTypes = null,
        $metadata = null,
        $rateLimit = null,
        $url = null,
        ?RequestOptions $requestOptions = null,
    ): WebhookUpdateResponse;

    /**
     * @param string|null $iterator The iterator returned from a prior invocation
     * @param int|null $limit Limit the number of returned items
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
