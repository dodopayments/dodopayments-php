<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Exceptions\WebhookException;
use Dodopayments\CursorPagePagination;
use Dodopayments\RequestOptions;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\Webhooks\AbandonedCheckoutDetectedWebhookEvent;
use Dodopayments\Webhooks\AbandonedCheckoutRecoveredWebhookEvent;
use Dodopayments\Webhooks\CreditAddedWebhookEvent;
use Dodopayments\Webhooks\CreditBalanceLowWebhookEvent;
use Dodopayments\Webhooks\CreditDeductedWebhookEvent;
use Dodopayments\Webhooks\CreditExpiredWebhookEvent;
use Dodopayments\Webhooks\CreditManualAdjustmentWebhookEvent;
use Dodopayments\Webhooks\CreditOverageChargedWebhookEvent;
use Dodopayments\Webhooks\CreditRolledOverWebhookEvent;
use Dodopayments\Webhooks\CreditRolloverForfeitedWebhookEvent;
use Dodopayments\Webhooks\DisputeAcceptedWebhookEvent;
use Dodopayments\Webhooks\DisputeCancelledWebhookEvent;
use Dodopayments\Webhooks\DisputeChallengedWebhookEvent;
use Dodopayments\Webhooks\DisputeExpiredWebhookEvent;
use Dodopayments\Webhooks\DisputeLostWebhookEvent;
use Dodopayments\Webhooks\DisputeOpenedWebhookEvent;
use Dodopayments\Webhooks\DisputeWonWebhookEvent;
use Dodopayments\Webhooks\DunningRecoveredWebhookEvent;
use Dodopayments\Webhooks\DunningStartedWebhookEvent;
use Dodopayments\Webhooks\LicenseKeyCreatedWebhookEvent;
use Dodopayments\Webhooks\PaymentCancelledWebhookEvent;
use Dodopayments\Webhooks\PaymentFailedWebhookEvent;
use Dodopayments\Webhooks\PaymentProcessingWebhookEvent;
use Dodopayments\Webhooks\PaymentSucceededWebhookEvent;
use Dodopayments\Webhooks\RefundFailedWebhookEvent;
use Dodopayments\Webhooks\RefundSucceededWebhookEvent;
use Dodopayments\Webhooks\SubscriptionActiveWebhookEvent;
use Dodopayments\Webhooks\SubscriptionCancelledWebhookEvent;
use Dodopayments\Webhooks\SubscriptionExpiredWebhookEvent;
use Dodopayments\Webhooks\SubscriptionFailedWebhookEvent;
use Dodopayments\Webhooks\SubscriptionOnHoldWebhookEvent;
use Dodopayments\Webhooks\SubscriptionPlanChangedWebhookEvent;
use Dodopayments\Webhooks\SubscriptionRenewedWebhookEvent;
use Dodopayments\Webhooks\SubscriptionUpdatedWebhookEvent;
use Dodopayments\Webhooks\WebhookDetails;
use Dodopayments\Webhooks\WebhookGetSecretResponse;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface WebhooksContract
{
    /**
     * @api
     *
     * @param string $url Url of the webhook
     * @param bool|null $disabled Create the webhook in a disabled state.
     *
     * Default is false
     * @param list<WebhookEventType|value-of<WebhookEventType>> $filterTypes Filter events to the webhook.
     *
     * Webhook event will only be sent for events in the list.
     * @param array<string,string>|null $headers Custom headers to be passed
     * @param string|null $idempotencyKey The request's idempotency key
     * @param array<string,string>|null $metadata Metadata to be passed to the webhook
     * Defaut is {}
     * @param RequestOpts|null $requestOptions
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
        RequestOptions|array|null $requestOptions = null,
    ): WebhookDetails;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): WebhookDetails;

    /**
     * @api
     *
     * @param string|null $description Description of the webhook
     * @param bool|null $disabled to Disable the endpoint, set it to true
     * @param list<WebhookEventType|value-of<WebhookEventType>>|null $filterTypes Filter events to the endpoint.
     *
     * Webhook event will only be sent for events in the list.
     * @param array<string,string>|null $metadata Metadata
     * @param int|null $rateLimit Rate limit
     * @param string|null $url Url endpoint
     * @param RequestOpts|null $requestOptions
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
        RequestOptions|array|null $requestOptions = null,
    ): WebhookDetails;

    /**
     * @api
     *
     * @param string|null $iterator The iterator returned from a prior invocation
     * @param int|null $limit Limit the number of returned items
     * @param RequestOpts|null $requestOptions
     *
     * @return CursorPagePagination<WebhookDetails>
     *
     * @throws APIException
     */
    public function list(
        ?string $iterator = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): CursorPagePagination;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveSecret(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): WebhookGetSecretResponse;

    /**
     * @api
     *
     * Unwraps a webhook event from its JSON representation.
     *
     * @throws WebhookException
     */
    public function unsafeUnwrap(
        string $body
    ): AbandonedCheckoutDetectedWebhookEvent|AbandonedCheckoutRecoveredWebhookEvent|CreditAddedWebhookEvent|CreditBalanceLowWebhookEvent|CreditDeductedWebhookEvent|CreditExpiredWebhookEvent|CreditManualAdjustmentWebhookEvent|CreditOverageChargedWebhookEvent|CreditRolledOverWebhookEvent|CreditRolloverForfeitedWebhookEvent|DisputeAcceptedWebhookEvent|DisputeCancelledWebhookEvent|DisputeChallengedWebhookEvent|DisputeExpiredWebhookEvent|DisputeLostWebhookEvent|DisputeOpenedWebhookEvent|DisputeWonWebhookEvent|DunningRecoveredWebhookEvent|DunningStartedWebhookEvent|LicenseKeyCreatedWebhookEvent|PaymentCancelledWebhookEvent|PaymentFailedWebhookEvent|PaymentProcessingWebhookEvent|PaymentSucceededWebhookEvent|RefundFailedWebhookEvent|RefundSucceededWebhookEvent|SubscriptionActiveWebhookEvent|SubscriptionCancelledWebhookEvent|SubscriptionExpiredWebhookEvent|SubscriptionFailedWebhookEvent|SubscriptionOnHoldWebhookEvent|SubscriptionPlanChangedWebhookEvent|SubscriptionRenewedWebhookEvent|SubscriptionUpdatedWebhookEvent;

    /**
     * @api
     *
     * Unwraps a webhook event from its JSON representation.
     *
     * @param array<string,string|list<string>>|null $headers
     *
     * @throws WebhookException
     */
    public function unwrap(
        string $body,
        ?array $headers = null,
        ?string $secret = null
    ): AbandonedCheckoutDetectedWebhookEvent|AbandonedCheckoutRecoveredWebhookEvent|CreditAddedWebhookEvent|CreditBalanceLowWebhookEvent|CreditDeductedWebhookEvent|CreditExpiredWebhookEvent|CreditManualAdjustmentWebhookEvent|CreditOverageChargedWebhookEvent|CreditRolledOverWebhookEvent|CreditRolloverForfeitedWebhookEvent|DisputeAcceptedWebhookEvent|DisputeCancelledWebhookEvent|DisputeChallengedWebhookEvent|DisputeExpiredWebhookEvent|DisputeLostWebhookEvent|DisputeOpenedWebhookEvent|DisputeWonWebhookEvent|DunningRecoveredWebhookEvent|DunningStartedWebhookEvent|LicenseKeyCreatedWebhookEvent|PaymentCancelledWebhookEvent|PaymentFailedWebhookEvent|PaymentProcessingWebhookEvent|PaymentSucceededWebhookEvent|RefundFailedWebhookEvent|RefundSucceededWebhookEvent|SubscriptionActiveWebhookEvent|SubscriptionCancelledWebhookEvent|SubscriptionExpiredWebhookEvent|SubscriptionFailedWebhookEvent|SubscriptionOnHoldWebhookEvent|SubscriptionPlanChangedWebhookEvent|SubscriptionRenewedWebhookEvent|SubscriptionUpdatedWebhookEvent;
}
