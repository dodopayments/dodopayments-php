<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\WebhookEvents\WebhookPayload\Data\CreditBalanceLow;
use Dodopayments\WebhookEvents\WebhookPayload\Data\CreditLedgerEntry;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Dispute;
use Dodopayments\WebhookEvents\WebhookPayload\Data\LicenseKey;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Payment;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Refund;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Subscription;

/**
 * @phpstan-import-type DataVariants from \Dodopayments\WebhookEvents\WebhookPayload\Data
 * @phpstan-import-type DataShape from \Dodopayments\WebhookEvents\WebhookPayload\Data
 *
 * @phpstan-type WebhookPayloadShape = array{
 *   businessID: string,
 *   data: DataShape,
 *   timestamp: \DateTimeInterface,
 *   type: WebhookEventType|value-of<WebhookEventType>,
 * }
 */
final class WebhookPayload implements BaseModel
{
    /** @use SdkModel<WebhookPayloadShape> */
    use SdkModel;

    #[Required('business_id')]
    public string $businessID;

    /**
     * The latest data at the time of delivery attempt.
     *
     * @var DataVariants $data
     */
    #[Required]
    public Payment|Subscription|Refund|Dispute|LicenseKey|CreditLedgerEntry|CreditBalanceLow $data;

    /**
     * The timestamp of when the event occurred (not necessarily the same of when it was delivered).
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * Event types for Dodo events.
     *
     * @var value-of<WebhookEventType> $type
     */
    #[Required(enum: WebhookEventType::class)]
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
     * @param DataShape $data
     * @param WebhookEventType|value-of<WebhookEventType> $type
     */
    public static function with(
        string $businessID,
        Payment|array|Subscription|Refund|Dispute|LicenseKey|CreditLedgerEntry|CreditBalanceLow $data,
        \DateTimeInterface $timestamp,
        WebhookEventType|string $type,
    ): self {
        $self = new self;

        $self['businessID'] = $businessID;
        $self['data'] = $data;
        $self['timestamp'] = $timestamp;
        $self['type'] = $type;

        return $self;
    }

    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * The latest data at the time of delivery attempt.
     *
     * @param DataShape $data
     */
    public function withData(
        Payment|array|Subscription|Refund|Dispute|LicenseKey|CreditLedgerEntry|CreditBalanceLow $data,
    ): self {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * The timestamp of when the event occurred (not necessarily the same of when it was delivered).
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * Event types for Dodo events.
     *
     * @param WebhookEventType|value-of<WebhookEventType> $type
     */
    public function withType(WebhookEventType|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
