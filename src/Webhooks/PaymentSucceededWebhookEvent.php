<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Payments\Payment;

/**
 * @phpstan-import-type PaymentShape from \Dodopayments\Payments\Payment
 *
 * @phpstan-type PaymentSucceededWebhookEventShape = array{
 *   businessID: string,
 *   data: Payment|PaymentShape,
 *   timestamp: \DateTimeInterface,
 *   type: 'payment.succeeded',
 * }
 */
final class PaymentSucceededWebhookEvent implements BaseModel
{
    /** @use SdkModel<PaymentSucceededWebhookEventShape> */
    use SdkModel;

    /**
     * The event type.
     *
     * @var 'payment.succeeded' $type
     */
    #[Required]
    public string $type = 'payment.succeeded';

    /**
     * The business identifier.
     */
    #[Required('business_id')]
    public string $businessID;

    #[Required]
    public Payment $data;

    /**
     * The timestamp of when the event occurred.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * `new PaymentSucceededWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaymentSucceededWebhookEvent::with(businessID: ..., data: ..., timestamp: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaymentSucceededWebhookEvent)
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
     * @param Payment|PaymentShape $data
     */
    public static function with(
        string $businessID,
        Payment|array $data,
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
     * @param Payment|PaymentShape $data
     */
    public function withData(Payment|array $data): self
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
     * @param 'payment.succeeded' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
