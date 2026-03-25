<?php

declare(strict_types=1);

namespace Dodopayments\YourWebhookURL;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\CreditBalanceLow;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\CreditLedgerEntry;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\LicenseKey;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Refund;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription;

/**
 * @see Dodopayments\Services\YourWebhookURLService::create()
 *
 * @phpstan-import-type DataVariants from \Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data
 * @phpstan-import-type DataShape from \Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data
 *
 * @phpstan-type YourWebhookURLCreateParamsShape = array{
 *   businessID: string,
 *   data: DataShape,
 *   timestamp: \DateTimeInterface,
 *   type: WebhookEventType|value-of<WebhookEventType>,
 *   webhookID: string,
 *   webhookSignature: string,
 *   webhookTimestamp: string,
 * }
 */
final class YourWebhookURLCreateParams implements BaseModel
{
    /** @use SdkModel<YourWebhookURLCreateParamsShape> */
    use SdkModel;
    use SdkParams;

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

    #[Required]
    public string $webhookID;

    #[Required]
    public string $webhookSignature;

    #[Required]
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
        string $webhookID,
        string $webhookSignature,
        string $webhookTimestamp,
    ): self {
        $self = new self;

        $self['businessID'] = $businessID;
        $self['data'] = $data;
        $self['timestamp'] = $timestamp;
        $self['type'] = $type;
        $self['webhookID'] = $webhookID;
        $self['webhookSignature'] = $webhookSignature;
        $self['webhookTimestamp'] = $webhookTimestamp;

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

    public function withWebhookID(string $webhookID): self
    {
        $self = clone $this;
        $self['webhookID'] = $webhookID;

        return $self;
    }

    public function withWebhookSignature(string $webhookSignature): self
    {
        $self = clone $this;
        $self['webhookSignature'] = $webhookSignature;

        return $self;
    }

    public function withWebhookTimestamp(string $webhookTimestamp): self
    {
        $self = clone $this;
        $self['webhookTimestamp'] = $webhookTimestamp;

        return $self;
    }
}
