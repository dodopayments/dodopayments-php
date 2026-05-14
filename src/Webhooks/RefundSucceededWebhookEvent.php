<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Refunds\Refund;

/**
 * @phpstan-import-type RefundShape from \Dodopayments\Refunds\Refund
 *
 * @phpstan-type RefundSucceededWebhookEventShape = array{
 *   businessID: string,
 *   data: Refund|RefundShape,
 *   timestamp: \DateTimeInterface,
 *   type: 'refund.succeeded',
 * }
 */
final class RefundSucceededWebhookEvent implements BaseModel
{
    /** @use SdkModel<RefundSucceededWebhookEventShape> */
    use SdkModel;

    /**
     * The event type.
     *
     * @var 'refund.succeeded' $type
     */
    #[Required]
    public string $type = 'refund.succeeded';

    /**
     * The business identifier.
     */
    #[Required('business_id')]
    public string $businessID;

    #[Required]
    public Refund $data;

    /**
     * The timestamp of when the event occurred.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * `new RefundSucceededWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RefundSucceededWebhookEvent::with(businessID: ..., data: ..., timestamp: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RefundSucceededWebhookEvent)
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
     * @param Refund|RefundShape $data
     */
    public static function with(
        string $businessID,
        Refund|array $data,
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
     * @param Refund|RefundShape $data
     */
    public function withData(Refund|array $data): self
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
     * @param 'refund.succeeded' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
