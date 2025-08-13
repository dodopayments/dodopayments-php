<?php

declare(strict_types=1);

namespace DodopaymentsClient\YourWebhookURL;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Concerns\Params;
use DodopaymentsClient\Core\Contracts\BaseModel;
use DodopaymentsClient\WebhookEvents\WebhookEventType;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\LicenseKey;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Refund;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription;

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
    use Model;
    use Params;

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
    public static function from(
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

    public function setBusinessID(string $businessID): self
    {
        $this->businessID = $businessID;

        return $this;
    }

    /**
     * The latest data at the time of delivery attempt.
     */
    public function setData(
        Dispute|LicenseKey|Payment|Refund|Subscription $data
    ): self {
        $this->data = $data;

        return $this;
    }

    /**
     * The timestamp of when the event occurred (not necessarily the same of when it was delivered).
     */
    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Event types for Dodo events.
     *
     * @param WebhookEventType::* $type
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setWebhookID(string $webhookID): self
    {
        $this->webhookID = $webhookID;

        return $this;
    }

    public function setWebhookSignature(string $webhookSignature): self
    {
        $this->webhookSignature = $webhookSignature;

        return $this;
    }

    public function setWebhookTimestamp(string $webhookTimestamp): self
    {
        $this->webhookTimestamp = $webhookTimestamp;

        return $this;
    }
}
