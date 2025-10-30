<?php

declare(strict_types=1);

namespace Dodopayments\UsageEvents;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\UsageEvents\EventInput\Metadata;

/**
 * @phpstan-type EventInputShape = array{
 *   customerID: string,
 *   eventID: string,
 *   eventName: string,
 *   metadata?: array<string, string|float|bool>|null,
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
    #[Api('customer_id')]
    public string $customerID;

    /**
     * Event Id acts as an idempotency key. Any subsequent requests with the same event_id will be ignored.
     */
    #[Api('event_id')]
    public string $eventID;

    /**
     * Name of the event.
     */
    #[Api('event_name')]
    public string $eventName;

    /**
     * Custom metadata. Only key value pairs are accepted, objects or arrays submitted will be rejected.
     *
     * @var array<string, string|float|bool>|null $metadata
     */
    #[Api(map: Metadata::class, nullable: true, optional: true)]
    public ?array $metadata;

    /**
     * Custom Timestamp. Defaults to current timestamp in UTC.
     * Timestamps that are older that 1 hour or after 5 mins, from current timestamp, will be rejected.
     */
    #[Api(nullable: true, optional: true)]
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
     * @param array<string, string|float|bool>|null $metadata
     */
    public static function with(
        string $customerID,
        string $eventID,
        string $eventName,
        ?array $metadata = null,
        ?\DateTimeInterface $timestamp = null,
    ): self {
        $obj = new self;

        $obj->customerID = $customerID;
        $obj->eventID = $eventID;
        $obj->eventName = $eventName;

        null !== $metadata && $obj->metadata = $metadata;
        null !== $timestamp && $obj->timestamp = $timestamp;

        return $obj;
    }

    /**
     * customer_id of the customer whose usage needs to be tracked.
     */
    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj->customerID = $customerID;

        return $obj;
    }

    /**
     * Event Id acts as an idempotency key. Any subsequent requests with the same event_id will be ignored.
     */
    public function withEventID(string $eventID): self
    {
        $obj = clone $this;
        $obj->eventID = $eventID;

        return $obj;
    }

    /**
     * Name of the event.
     */
    public function withEventName(string $eventName): self
    {
        $obj = clone $this;
        $obj->eventName = $eventName;

        return $obj;
    }

    /**
     * Custom metadata. Only key value pairs are accepted, objects or arrays submitted will be rejected.
     *
     * @param array<string, string|float|bool>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * Custom Timestamp. Defaults to current timestamp in UTC.
     * Timestamps that are older that 1 hour or after 5 mins, from current timestamp, will be rejected.
     */
    public function withTimestamp(?\DateTimeInterface $timestamp): self
    {
        $obj = clone $this;
        $obj->timestamp = $timestamp;

        return $obj;
    }
}
