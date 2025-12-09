<?php

declare(strict_types=1);

namespace Dodopayments\UsageEvents;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\UsageEvents\EventInput\Metadata;

/**
 * @phpstan-type EventInputShape = array{
 *   customer_id: string,
 *   event_id: string,
 *   event_name: string,
 *   metadata?: array<string,string|float|bool>|null,
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
    #[Required]
    public string $customer_id;

    /**
     * Event Id acts as an idempotency key. Any subsequent requests with the same event_id will be ignored.
     */
    #[Required]
    public string $event_id;

    /**
     * Name of the event.
     */
    #[Required]
    public string $event_name;

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
     * EventInput::with(customer_id: ..., event_id: ..., event_name: ...)
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
     * @param array<string,string|float|bool>|null $metadata
     */
    public static function with(
        string $customer_id,
        string $event_id,
        string $event_name,
        ?array $metadata = null,
        ?\DateTimeInterface $timestamp = null,
    ): self {
        $obj = new self;

        $obj['customer_id'] = $customer_id;
        $obj['event_id'] = $event_id;
        $obj['event_name'] = $event_name;

        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $timestamp && $obj['timestamp'] = $timestamp;

        return $obj;
    }

    /**
     * customer_id of the customer whose usage needs to be tracked.
     */
    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj['customer_id'] = $customerID;

        return $obj;
    }

    /**
     * Event Id acts as an idempotency key. Any subsequent requests with the same event_id will be ignored.
     */
    public function withEventID(string $eventID): self
    {
        $obj = clone $this;
        $obj['event_id'] = $eventID;

        return $obj;
    }

    /**
     * Name of the event.
     */
    public function withEventName(string $eventName): self
    {
        $obj = clone $this;
        $obj['event_name'] = $eventName;

        return $obj;
    }

    /**
     * Custom metadata. Only key value pairs are accepted, objects or arrays submitted will be rejected.
     *
     * @param array<string,string|float|bool>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * Custom Timestamp. Defaults to current timestamp in UTC.
     * Timestamps that are older that 1 hour or after 5 mins, from current timestamp, will be rejected.
     */
    public function withTimestamp(?\DateTimeInterface $timestamp): self
    {
        $obj = clone $this;
        $obj['timestamp'] = $timestamp;

        return $obj;
    }
}
