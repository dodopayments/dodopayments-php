<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type InvoiceEventShape = array{
 *   actor: string,
 *   createdAt: \DateTimeInterface,
 *   eventID: string,
 *   eventType: string,
 *   payload: mixed,
 *   rowVersion: int,
 *   actorEmail?: string|null,
 * }
 */
final class InvoiceEvent implements BaseModel
{
    /** @use SdkModel<InvoiceEventShape> */
    use SdkModel;

    /**
     * A user ID, `api_key`, `customer` or `system`.
     */
    #[Required]
    public string $actor;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('event_id')]
    public string $eventID;

    #[Required('event_type')]
    public string $eventType;

    #[Required]
    public mixed $payload;

    #[Required('row_version')]
    public int $rowVersion;

    #[Optional('actor_email', nullable: true)]
    public ?string $actorEmail;

    /**
     * `new InvoiceEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceEvent::with(
     *   actor: ...,
     *   createdAt: ...,
     *   eventID: ...,
     *   eventType: ...,
     *   payload: ...,
     *   rowVersion: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceEvent)
     *   ->withActor(...)
     *   ->withCreatedAt(...)
     *   ->withEventID(...)
     *   ->withEventType(...)
     *   ->withPayload(...)
     *   ->withRowVersion(...)
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
     */
    public static function with(
        string $actor,
        \DateTimeInterface $createdAt,
        string $eventID,
        string $eventType,
        mixed $payload,
        int $rowVersion,
        ?string $actorEmail = null,
    ): self {
        $self = new self;

        $self['actor'] = $actor;
        $self['createdAt'] = $createdAt;
        $self['eventID'] = $eventID;
        $self['eventType'] = $eventType;
        $self['payload'] = $payload;
        $self['rowVersion'] = $rowVersion;

        null !== $actorEmail && $self['actorEmail'] = $actorEmail;

        return $self;
    }

    /**
     * A user ID, `api_key`, `customer` or `system`.
     */
    public function withActor(string $actor): self
    {
        $self = clone $this;
        $self['actor'] = $actor;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withEventID(string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }

    public function withEventType(string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    public function withPayload(mixed $payload): self
    {
        $self = clone $this;
        $self['payload'] = $payload;

        return $self;
    }

    public function withRowVersion(int $rowVersion): self
    {
        $self = clone $this;
        $self['rowVersion'] = $rowVersion;

        return $self;
    }

    public function withActorEmail(?string $actorEmail): self
    {
        $self = clone $this;
        $self['actorEmail'] = $actorEmail;

        return $self;
    }
}
