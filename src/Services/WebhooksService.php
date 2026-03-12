<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Conversion;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Exceptions\WebhookException;
use Dodopayments\Core\Util;
use Dodopayments\CursorPagePagination;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\WebhooksContract;
use Dodopayments\Services\Webhooks\HeadersService;
use Dodopayments\WebhookEvents\WebhookEventType;
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
use Dodopayments\Webhooks\UnsafeUnwrapWebhookEvent;
use Dodopayments\Webhooks\UnwrapWebhookEvent;
use Dodopayments\Webhooks\WebhookDetails;
use Dodopayments\Webhooks\WebhookGetSecretResponse;
use StandardWebhooks\Exception\WebhookVerificationException;
use StandardWebhooks\Webhook;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
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
    ): WebhookDetails {
        $params = Util::removeNulls(
            [
                'url' => $url,
                'description' => $description,
                'disabled' => $disabled,
                'filterTypes' => $filterTypes,
                'headers' => $headers,
                'idempotencyKey' => $idempotencyKey,
                'metadata' => $metadata,
                'rateLimit' => $rateLimit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a webhook by id
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
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
    ): WebhookDetails {
        $params = Util::removeNulls(
            [
                'description' => $description,
                'disabled' => $disabled,
                'filterTypes' => $filterTypes,
                'metadata' => $metadata,
                'rateLimit' => $rateLimit,
                'url' => $url,
            ],
        );

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
    ): CursorPagePagination {
        $params = Util::removeNulls(['iterator' => $iterator, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a webhook by id
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveSecret(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): WebhookGetSecretResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveSecret($webhookID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Unwraps a webhook event from its JSON representation.
     *
     * @throws WebhookException
     */
    public function unsafeUnwrap(
        string $body
    ): CreditAddedWebhookEvent|CreditBalanceLowWebhookEvent|CreditDeductedWebhookEvent|CreditExpiredWebhookEvent|CreditManualAdjustmentWebhookEvent|CreditOverageChargedWebhookEvent|CreditRolledOverWebhookEvent|CreditRolloverForfeitedWebhookEvent|DisputeAcceptedWebhookEvent|DisputeCancelledWebhookEvent|DisputeChallengedWebhookEvent|DisputeExpiredWebhookEvent|DisputeLostWebhookEvent|DisputeOpenedWebhookEvent|DisputeWonWebhookEvent|LicenseKeyCreatedWebhookEvent|PaymentCancelledWebhookEvent|PaymentFailedWebhookEvent|PaymentProcessingWebhookEvent|PaymentSucceededWebhookEvent|RefundFailedWebhookEvent|RefundSucceededWebhookEvent|SubscriptionActiveWebhookEvent|SubscriptionCancelledWebhookEvent|SubscriptionExpiredWebhookEvent|SubscriptionFailedWebhookEvent|SubscriptionOnHoldWebhookEvent|SubscriptionPlanChangedWebhookEvent|SubscriptionRenewedWebhookEvent|SubscriptionUpdatedWebhookEvent {
        try {
            $decoded = Util::decodeJson($body);

            // @phpstan-ignore return.type
            return Conversion::coerce(UnsafeUnwrapWebhookEvent::class, value: $decoded);
        } catch (\Throwable $e) {
            throw new WebhookException('Error parsing webhook body', previous: $e);
        }
    }

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
    ): CreditAddedWebhookEvent|CreditBalanceLowWebhookEvent|CreditDeductedWebhookEvent|CreditExpiredWebhookEvent|CreditManualAdjustmentWebhookEvent|CreditOverageChargedWebhookEvent|CreditRolledOverWebhookEvent|CreditRolloverForfeitedWebhookEvent|DisputeAcceptedWebhookEvent|DisputeCancelledWebhookEvent|DisputeChallengedWebhookEvent|DisputeExpiredWebhookEvent|DisputeLostWebhookEvent|DisputeOpenedWebhookEvent|DisputeWonWebhookEvent|LicenseKeyCreatedWebhookEvent|PaymentCancelledWebhookEvent|PaymentFailedWebhookEvent|PaymentProcessingWebhookEvent|PaymentSucceededWebhookEvent|RefundFailedWebhookEvent|RefundSucceededWebhookEvent|SubscriptionActiveWebhookEvent|SubscriptionCancelledWebhookEvent|SubscriptionExpiredWebhookEvent|SubscriptionFailedWebhookEvent|SubscriptionOnHoldWebhookEvent|SubscriptionPlanChangedWebhookEvent|SubscriptionRenewedWebhookEvent|SubscriptionUpdatedWebhookEvent {
        if (null !== $headers) {
            $secret = $secret ?? ($this->client->webhookKey ?: null);
            if (null === $secret) {
                throw new WebhookException('Webhook key must not be null in order to unwrap');
            }

            try {
                $flatHeaders = array_map(fn (string|array $v): string => is_array($v) ? $v[0] : $v, $headers);
                $webhook = new Webhook($secret);
                $webhook->verify($body, $flatHeaders);
            } catch (WebhookVerificationException $e) {
                throw new WebhookException('Could not verify webhook event signature', previous: $e);
            }
        }

        try {
            $decoded = Util::decodeJson($body);

            // @phpstan-ignore return.type
            return Conversion::coerce(UnwrapWebhookEvent::class, value: $decoded);
        } catch (\Throwable $e) {
            throw new WebhookException('Error parsing webhook body', previous: $e);
        }
    }
}
