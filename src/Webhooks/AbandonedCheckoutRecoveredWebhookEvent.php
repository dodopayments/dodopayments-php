<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Webhooks\AbandonedCheckoutRecoveredWebhookEvent\Data;

/**
 * @phpstan-import-type DataShape from \Dodopayments\Webhooks\AbandonedCheckoutRecoveredWebhookEvent\Data
 *
 * @phpstan-type AbandonedCheckoutRecoveredWebhookEventShape = array{
 *   businessID: string,
 *   data: Data|DataShape,
 *   timestamp: \DateTimeInterface,
 *   type: 'abandoned_checkout.recovered',
 * }
 */
final class AbandonedCheckoutRecoveredWebhookEvent implements BaseModel
{
    /** @use SdkModel<AbandonedCheckoutRecoveredWebhookEventShape> */
    use SdkModel;

    /**
     * The event type.
     *
     * @var 'abandoned_checkout.recovered' $type
     */
    #[Required]
    public string $type = 'abandoned_checkout.recovered';

    /**
     * The business identifier.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * Webhook payload for abandoned_checkout.detected and abandoned_checkout.recovered events.
     */
    #[Required]
    public Data $data;

    /**
     * The timestamp of when the event occurred.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * `new AbandonedCheckoutRecoveredWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AbandonedCheckoutRecoveredWebhookEvent::with(
     *   businessID: ..., data: ..., timestamp: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AbandonedCheckoutRecoveredWebhookEvent)
     *   ->withBusinessID(...)
     *   ->withData(...)
     *   ->withTimestamp(...)
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
     * @param Data|DataShape $data
     */
    public static function with(
        string $businessID,
        Data|array $data,
        \DateTimeInterface $timestamp
    ): self {
        $self = new self;

        $self['businessID'] = $businessID;
        $self['data'] = $data;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * The business identifier.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * Webhook payload for abandoned_checkout.detected and abandoned_checkout.recovered events.
     *
     * @param Data|DataShape $data
     */
    public function withData(Data|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * The timestamp of when the event occurred.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * The event type.
     *
     * @param 'abandoned_checkout.recovered' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
