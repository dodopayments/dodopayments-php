<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Dispute;
use Dodopayments\WebhookEvents\WebhookPayload\Data\LicenseKey;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Payment;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Refund;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Subscription;

/**
 * @phpstan-type webhook_payload_alias = array{
 *   businessID: string,
 *   data: Payment|Subscription|Refund|Dispute|LicenseKey,
 *   timestamp: \DateTimeInterface,
 *   type: WebhookEventType::*,
 * }
 */
final class WebhookPayload implements BaseModel
{
    use Model;

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
    ): self {
        $obj = new self;

        $obj->businessID = $businessID;
        $obj->data = $data;
        $obj->timestamp = $timestamp;
        $obj->type = $type;

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
}
