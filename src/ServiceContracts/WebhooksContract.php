<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\CursorPagePagination;
use Dodopayments\RequestOptions;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\Webhooks\WebhookDetails;
use Dodopayments\Webhooks\WebhookGetSecretResponse;

use const Dodopayments\Core\OMIT as omit;

interface WebhooksContract
{
    /**
     * @api
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
    ): WebhookDetails;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): WebhookDetails;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookDetails;

    /**
     * @api
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
    ): WebhookDetails;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $webhookID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): WebhookDetails;

    /**
     * @api
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
    ): CursorPagePagination;

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
    ): CursorPagePagination;

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveSecret(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): WebhookGetSecretResponse;
}
