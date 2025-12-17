<?php

declare(strict_types=1);

namespace Dodopayments\UsageEvents;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\UsageEvents\EventInput\Metadata;

/**
 * @phpstan-import-type MetadataShape from \Dodopayments\UsageEvents\EventInput\Metadata
 *
 * @phpstan-type EventInputShape = array{
 *   customerID: string,
 *   eventID: string,
 *   eventName: string,
 *   metadata?: array<string,MetadataShape>|null,
 *   timestamp?: \DateTimeInterface|null,
 * }
 */
final class EventInput implements BaseModel
{
    /** @use SdkModel<EventInputShape> */
    use SdkModel;

    /**
     * customer_id of the customer whose usage needs to be tracked.
     */
    #[Required('customer_id')]
    public string $customerID;

    /**
     * Event Id acts as an idempotency key. Any subsequent requests with the same event_id will be ignored.
     */
    #[Required('event_id')]
    public string $eventID;

    /**
     * Name of the event.
     */
    #[Required('event_name')]
    public string $eventName;

    /**
     * Custom metadata. Only key value pairs are accepted, objects or arrays submitted will be rejected.
     *
     * @var array<string,string|float|bool>|null $metadata
     */
    #[Optional(map: Metadata::class, nullable: true)]
    public ?array $metadata;

    /**
     * Custom Timestamp. Defaults to current timestamp in UTC.
     * Timestamps that are older that 1 hour or after 5 mins, from current timestamp, will be rejected.
     */
    #[Optional(nullable: true)]
    public ?\DateTimeInterface $timestamp;

    /**
     * `new EventInput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EventInput::with(customerID: ..., eventID: ..., eventName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EventInput)->withCustomerID(...)->withEventID(...)->withEventName(...)
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
        string $customerID,
        string $eventID,
        string $eventName,
        ?array $metadata = null,
        ?\DateTimeInterface $timestamp = null,
    ): self {
        $self = new self;

        $self['customerID'] = $customerID;
        $self['eventID'] = $eventID;
        $self['eventName'] = $eventName;

        null !== $metadata && $self['metadata'] = $metadata;
        null !== $timestamp && $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * customer_id of the customer whose usage needs to be tracked.
     */
    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * Event Id acts as an idempotency key. Any subsequent requests with the same event_id will be ignored.
     */
    public function withEventID(string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }

    /**
     * Name of the event.
     */
    public function withEventName(string $eventName): self
    {
        $self = clone $this;
        $self['eventName'] = $eventName;

        return $self;
    }

    /**
     * Custom metadata. Only key value pairs are accepted, objects or arrays submitted will be rejected.
     *
     * @param array<string,MetadataShape>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Custom Timestamp. Defaults to current timestamp in UTC.
     * Timestamps that are older that 1 hour or after 5 mins, from current timestamp, will be rejected.
     */
    public function withTimestamp(?\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }
}
