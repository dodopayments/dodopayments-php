<?php

declare(strict_types=1);

namespace Dodopayments\UsageEvents;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\UsageEvents\Event\Metadata;

/**
 * @phpstan-import-type MetadataVariants from \Dodopayments\UsageEvents\Event\Metadata
 * @phpstan-import-type MetadataShape from \Dodopayments\UsageEvents\Event\Metadata
 *
 * @phpstan-type EventShape = array{
 *   businessID: string,
 *   customerID: string,
 *   eventID: string,
 *   eventName: string,
 *   timestamp: \DateTimeInterface,
 *   metadata?: array<string,MetadataShape>|null,
 * }
 */
final class Event implements BaseModel
{
    /** @use SdkModel<EventShape> */
    use SdkModel;

    #[Required('business_id')]
    public string $businessID;

    #[Required('customer_id')]
    public string $customerID;

    #[Required('event_id')]
    public string $eventID;

    #[Required('event_name')]
    public string $eventName;

    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     *
     * @var array<string,MetadataVariants>|null $metadata
     */
    #[Optional(map: Metadata::class, nullable: true)]
    public ?array $metadata;

    /**
     * `new Event()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Event::with(
     *   businessID: ..., customerID: ..., eventID: ..., eventName: ..., timestamp: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Event)
     *   ->withBusinessID(...)
     *   ->withCustomerID(...)
     *   ->withEventID(...)
     *   ->withEventName(...)
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
     * @param array<string,MetadataShape>|null $metadata
     */
    public static function with(
        string $businessID,
        string $customerID,
        string $eventID,
        string $eventName,
        \DateTimeInterface $timestamp,
        ?array $metadata = null,
    ): self {
        $self = new self;

        $self['businessID'] = $businessID;
        $self['customerID'] = $customerID;
        $self['eventID'] = $eventID;
        $self['eventName'] = $eventName;
        $self['timestamp'] = $timestamp;

        null !== $metadata && $self['metadata'] = $metadata;

        return $self;
    }

    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    public function withEventID(string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }

    public function withEventName(string $eventName): self
    {
        $self = clone $this;
        $self['eventName'] = $eventName;

        return $self;
    }

    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     *
     * @param array<string,MetadataShape>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }
}
