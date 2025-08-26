<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\RequestOptions;
use Dodopayments\Responses\Webhooks\WebhookGetSecretResponse;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\Webhooks\WebhookDetails;

use const Dodopayments\Core\OMIT as omit;

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
        $description = omit,
        $disabled = omit,
        $filterTypes = omit,
        $headers = omit,
        $idempotencyKey = omit,
        $metadata = omit,
        $rateLimit = omit,
        ?RequestOptions $requestOptions = null,
    ): WebhookDetails;

    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookDetails;

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
        $description = omit,
        $disabled = omit,
        $filterTypes = omit,
        $metadata = omit,
        $rateLimit = omit,
        $url = omit,
        ?RequestOptions $requestOptions = null,
    ): WebhookDetails;

    /**
     * @param string|null $iterator The iterator returned from a prior invocation
     * @param int|null $limit Limit the number of returned items
     */
    public function list(
        $iterator = omit,
        $limit = omit,
        ?RequestOptions $requestOptions = null
    ): WebhookDetails;

    public function delete(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): mixed;

    public function retrieveSecret(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookGetSecretResponse;
}
