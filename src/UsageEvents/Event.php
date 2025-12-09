<?php

declare(strict_types=1);

namespace Dodopayments\UsageEvents;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\UsageEvents\Event\Metadata;

/**
 * @phpstan-type EventShape = array{
 *   business_id: string,
 *   customer_id: string,
 *   event_id: string,
 *   event_name: string,
 *   timestamp: \DateTimeInterface,
 *   metadata?: array<string,string|float|bool>|null,
 * }
 */
final class Event implements BaseModel
{
    /** @use SdkModel<EventShape> */
    use SdkModel;

    #[Api]
    public string $business_id;

    #[Api]
    public string $customer_id;

    #[Api]
    public string $event_id;

    #[Api]
    public string $event_name;

    #[Api]
    public \DateTimeInterface $timestamp;

    /**
     * Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     *
     * @var array<string,string|float|bool>|null $metadata
     */
    #[Api(map: Metadata::class, nullable: true, optional: true)]
    public ?array $metadata;

    /**
     * `new Event()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Event::with(
     *   business_id: ...,
     *   customer_id: ...,
     *   event_id: ...,
     *   event_name: ...,
     *   timestamp: ...,
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
     * @param array<string,string|float|bool>|null $metadata
     */
    public static function with(
        string $business_id,
        string $customer_id,
        string $event_id,
        string $event_name,
        \DateTimeInterface $timestamp,
        ?array $metadata = null,
    ): self {
        $obj = new self;

        $obj['business_id'] = $business_id;
        $obj['customer_id'] = $customer_id;
        $obj['event_id'] = $event_id;
        $obj['event_name'] = $event_name;
        $obj['timestamp'] = $timestamp;

        null !== $metadata && $obj['metadata'] = $metadata;

        return $obj;
    }

    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['business_id'] = $businessID;

        return $obj;
    }

    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj['customer_id'] = $customerID;

        return $obj;
    }

    public function withEventID(string $eventID): self
    {
        $obj = clone $this;
        $obj['event_id'] = $eventID;

        return $obj;
    }

    public function withEventName(string $eventName): self
    {
        $obj = clone $this;
        $obj['event_name'] = $eventName;

        return $obj;
    }

    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $obj = clone $this;
        $obj['timestamp'] = $timestamp;

        return $obj;
    }

    /**
     * Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     *
     * @param array<string,string|float|bool>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }
}
