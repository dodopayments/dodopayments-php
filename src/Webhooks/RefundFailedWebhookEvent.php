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
 * @phpstan-type RefundFailedWebhookEventShape = array{
 *   businessID: string,
 *   data: Refund|RefundShape,
 *   timestamp: \DateTimeInterface,
 *   type: 'refund.failed',
 * }
 */
final class RefundFailedWebhookEvent implements BaseModel
{
    /** @use SdkModel<RefundFailedWebhookEventShape> */
    use SdkModel;

    /**
     * The event type.
     *
     * @var 'refund.failed' $type
     */
    #[Required]
    public string $type = 'refund.failed';

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
     * `new RefundFailedWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RefundFailedWebhookEvent::with(businessID: ..., data: ..., timestamp: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RefundFailedWebhookEvent)
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
     * @param 'refund.failed' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
