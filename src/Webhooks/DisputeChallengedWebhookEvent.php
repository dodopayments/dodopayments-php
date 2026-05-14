<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Disputes\Dispute;

/**
 * @phpstan-import-type DisputeShape from \Dodopayments\Disputes\Dispute
 *
 * @phpstan-type DisputeChallengedWebhookEventShape = array{
 *   businessID: string,
 *   data: Dispute|DisputeShape,
 *   timestamp: \DateTimeInterface,
 *   type: 'dispute.challenged',
 * }
 */
final class DisputeChallengedWebhookEvent implements BaseModel
{
    /** @use SdkModel<DisputeChallengedWebhookEventShape> */
    use SdkModel;

    /**
     * The event type.
     *
     * @var 'dispute.challenged' $type
     */
    #[Required]
    public string $type = 'dispute.challenged';

    /**
     * The business identifier.
     */
    #[Required('business_id')]
    public string $businessID;

    #[Required]
    public Dispute $data;

    /**
     * The timestamp of when the event occurred.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * `new DisputeChallengedWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DisputeChallengedWebhookEvent::with(businessID: ..., data: ..., timestamp: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DisputeChallengedWebhookEvent)
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
     * @param Dispute|DisputeShape $data
     */
    public static function with(
        string $businessID,
        Dispute|array $data,
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
     * @param Dispute|DisputeShape $data
     */
    public function withData(Dispute|array $data): self
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
     * @param 'dispute.challenged' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
