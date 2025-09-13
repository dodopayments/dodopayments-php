<?php

declare(strict_types=1);

namespace Dodopayments\UsageEvents;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\UsageEvents\Event\Metadata;

/**
 * @phpstan-type event_alias = array{
 *   businessID: string,
 *   customerID: string,
 *   eventID: string,
 *   eventName: string,
 *   timestamp: \DateTimeInterface,
 *   metadata?: array<string, string|float|bool>|null,
 * }
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class Event implements BaseModel
{
    /** @use SdkModel<event_alias> */
    use SdkModel;

    #[Api('business_id')]
    public string $businessID;

    #[Api('customer_id')]
    public string $customerID;

    #[Api('event_id')]
    public string $eventID;

    #[Api('event_name')]
    public string $eventName;

    #[Api]
    public \DateTimeInterface $timestamp;

    /**
     * Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     *
     * @var array<string, string|float|bool>|null $metadata
     */
    #[Api(map: Metadata::class, nullable: true, optional: true)]
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
     * @param array<string, string|float|bool>|null $metadata
     */
    public static function with(
        string $businessID,
        string $customerID,
        string $eventID,
        string $eventName,
        \DateTimeInterface $timestamp,
        ?array $metadata = null,
    ): self {
        $obj = new self;

        $obj->businessID = $businessID;
        $obj->customerID = $customerID;
        $obj->eventID = $eventID;
        $obj->eventName = $eventName;
        $obj->timestamp = $timestamp;

        null !== $metadata && $obj->metadata = $metadata;

        return $obj;
    }

    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj->customerID = $customerID;

        return $obj;
    }

    public function withEventID(string $eventID): self
    {
        $obj = clone $this;
        $obj->eventID = $eventID;

        return $obj;
    }

    public function withEventName(string $eventName): self
    {
        $obj = clone $this;
        $obj->eventName = $eventName;

        return $obj;
    }

    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $obj = clone $this;
        $obj->timestamp = $timestamp;

        return $obj;
    }

    /**
     * Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     *
     * @param array<string, string|float|bool>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }
}
