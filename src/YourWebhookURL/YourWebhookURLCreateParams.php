<?php

declare(strict_types=1);

namespace Dodopayments\YourWebhookURL;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\LicenseKey;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Refund;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription;

/**
 * @phpstan-type create_params = array{
 *   businessID: string,
 *   data: Payment|Subscription|Refund|Dispute|LicenseKey,
 *   timestamp: \DateTimeInterface,
 *   type: WebhookEventType::*,
 *   webhookID: string,
 *   webhookSignature: string,
 *   webhookTimestamp: string,
 * }
 */
final class YourWebhookURLCreateParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    #[Api('business_id')]
    public string $businessID;

    /**
     * The latest data at the time of delivery attempt.
     */
    #[Api]
    public Dispute|LicenseKey|Payment|Refund|Subscription $data;

    /**
     * The timestamp of when the event occurred (not necessarily the same of when it was delivered).
     */
    #[Api]
    public \DateTimeInterface $timestamp;

    /**
     * Event types for Dodo events.
     *
     * @var WebhookEventType::* $type
     */
    #[Api(enum: WebhookEventType::class)]
    public string $type;

    #[Api]
    public string $webhookID;

    #[Api]
    public string $webhookSignature;

    #[Api]
    public string $webhookTimestamp;

    /**
     * `new YourWebhookURLCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * YourWebhookURLCreateParams::with(
     *   businessID: ...,
     *   data: ...,
     *   timestamp: ...,
     *   type: ...,
     *   webhookID: ...,
     *   webhookSignature: ...,
     *   webhookTimestamp: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new YourWebhookURLCreateParams)
     *   ->withBusinessID(...)
     *   ->withData(...)
     *   ->withTimestamp(...)
     *   ->withType(...)
     *   ->withWebhookID(...)
     *   ->withWebhookSignature(...)
     *   ->withWebhookTimestamp(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param WebhookEventType::* $type
     */
    public static function with(
        string $businessID,
        Dispute|LicenseKey|Payment|Refund|Subscription $data,
        \DateTimeInterface $timestamp,
        string $type,
        string $webhookID,
        string $webhookSignature,
        string $webhookTimestamp,
    ): self {
        $obj = new self;

        $obj->businessID = $businessID;
        $obj->data = $data;
        $obj->timestamp = $timestamp;
        $obj->type = $type;
        $obj->webhookID = $webhookID;
        $obj->webhookSignature = $webhookSignature;
        $obj->webhookTimestamp = $webhookTimestamp;

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
        Dispute|LicenseKey|Payment|Refund|Subscription $data
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
     * @param WebhookEventType::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    public function withWebhookID(string $webhookID): self
    {
        $obj = clone $this;
        $obj->webhookID = $webhookID;

        return $obj;
    }

    public function withWebhookSignature(string $webhookSignature): self
    {
        $obj = clone $this;
        $obj->webhookSignature = $webhookSignature;

        return $obj;
    }

    public function withWebhookTimestamp(string $webhookTimestamp): self
    {
        $obj = clone $this;
        $obj->webhookTimestamp = $webhookTimestamp;

        return $obj;
    }
}
