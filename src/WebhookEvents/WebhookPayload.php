<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Dispute;
use Dodopayments\WebhookEvents\WebhookPayload\Data\LicenseKey;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Payment;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Refund;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Subscription;

/**
 * @phpstan-type webhook_payload = array{
 *   businessID: string,
 *   data: STAINLESS_FIXME_payment_alias|STAINLESS_FIXME_subscription_alias|STAINLESS_FIXME_refund_alias|STAINLESS_FIXME_dispute_alias|STAINLESS_FIXME_license_key,
 *   timestamp: \DateTimeInterface,
 *   type: value-of<WebhookEventType>,
 * }
 */
final class WebhookPayload implements BaseModel
{
    /** @use SdkModel<webhook_payload> */
    use SdkModel;

    #[Api('business_id')]
    public string $businessID;

    /**
     * The latest data at the time of delivery attempt.
     */
    #[Api]
    public Payment|Subscription|Refund|Dispute|LicenseKey $data;

    /**
     * The timestamp of when the event occurred (not necessarily the same of when it was delivered).
     */
    #[Api]
    public \DateTimeInterface $timestamp;

    /**
     * Event types for Dodo events.
     *
     * @var value-of<WebhookEventType> $type
     */
    #[Api(enum: WebhookEventType::class)]
    public string $type;

    /**
     * `new WebhookPayload()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookPayload::with(businessID: ..., data: ..., timestamp: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookPayload)
     *   ->withBusinessID(...)
     *   ->withData(...)
     *   ->withTimestamp(...)
     *   ->withType(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param WebhookEventType|value-of<WebhookEventType> $type
     */
    public static function with(
        string $businessID,
        Payment|Subscription|Refund|Dispute|LicenseKey $data,
        \DateTimeInterface $timestamp,
        WebhookEventType|string $type,
    ): self {
        $obj = new self;

        $obj->businessID = $businessID;
        $obj->data = $data;
        $obj->timestamp = $timestamp;
        $obj->type = $type instanceof WebhookEventType ? $type->value : $type;

        return $obj;
    }

    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    /**
     * The latest data at the time of delivery attempt.
     */
    public function withData(
        Payment|Subscription|Refund|Dispute|LicenseKey $data
    ): self {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    /**
     * The timestamp of when the event occurred (not necessarily the same of when it was delivered).
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $obj = clone $this;
        $obj->timestamp = $timestamp;

        return $obj;
    }

    /**
     * Event types for Dodo events.
     *
     * @param WebhookEventType|value-of<WebhookEventType> $type
     */
    public function withType(WebhookEventType|string $type): self
    {
        $obj = clone $this;
        $obj->type = $type instanceof WebhookEventType ? $type->value : $type;

        return $obj;
    }
}
