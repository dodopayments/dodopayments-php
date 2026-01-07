<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Disputes\Dispute;
use Dodopayments\Webhooks\DisputeOpenedWebhookEvent\Type;

/**
 * @phpstan-import-type DisputeShape from \Dodopayments\Disputes\Dispute
 *
 * @phpstan-type DisputeOpenedWebhookEventShape = array{
 *   businessID: string,
 *   data: Dispute|DisputeShape,
 *   timestamp: \DateTimeInterface,
 *   type: Type|value-of<Type>,
 * }
 */
final class DisputeOpenedWebhookEvent implements BaseModel
{
    /** @use SdkModel<DisputeOpenedWebhookEventShape> */
    use SdkModel;

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
     * The event type.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new DisputeOpenedWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DisputeOpenedWebhookEvent::with(
     *   businessID: ..., data: ..., timestamp: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DisputeOpenedWebhookEvent)
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
     * @param Dispute|DisputeShape $data
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $businessID,
        Dispute|array $data,
        \DateTimeInterface $timestamp,
        Type|string $type,
    ): self {
        $self = new self;

        $self['businessID'] = $businessID;
        $self['data'] = $data;
        $self['timestamp'] = $timestamp;
        $self['type'] = $type;

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
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
