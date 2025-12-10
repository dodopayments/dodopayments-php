<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\CursorPagePagination;
use Dodopayments\RequestOptions;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\Webhooks\WebhookDetails;
use Dodopayments\Webhooks\WebhookGetSecretResponse;

interface WebhooksContract
{
    /**
     * @api
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
        ?string $iterator = null,
        ?int $limit = null,
        ?RequestOptions $requestOptions = null,
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
