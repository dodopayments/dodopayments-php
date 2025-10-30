<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Webhooks\PaymentCancelledWebhookEvent\Data;
use Dodopayments\Webhooks\PaymentCancelledWebhookEvent\Type;

/**
 * @phpstan-type PaymentCancelledWebhookEventShape = array{
 *   businessID: string,
 *   data: Data,
 *   timestamp: \DateTimeInterface,
 *   type: value-of<Type>,
 * }
 */
final class PaymentCancelledWebhookEvent implements BaseModel
{
    /** @use SdkModel<PaymentCancelledWebhookEventShape> */
    use SdkModel;

    /**
     * The business identifier.
     */
    #[Api('business_id')]
    public string $businessID;

    /**
     * Event-specific data.
     */
    #[Api]
    public Data $data;

    /**
     * The timestamp of when the event occurred.
     */
    #[Api]
    public \DateTimeInterface $timestamp;

    /**
     * The event type.
     *
     * @var value-of<Type> $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * `new PaymentCancelledWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaymentCancelledWebhookEvent::with(
     *   businessID: ..., data: ..., timestamp: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaymentCancelledWebhookEvent)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $businessID,
        Data $data,
        \DateTimeInterface $timestamp,
        Type|string $type,
    ): self {
        $obj = new self;

        $obj->businessID = $businessID;
        $obj->data = $data;
        $obj->timestamp = $timestamp;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * The business identifier.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    /**
     * Event-specific data.
     */
    public function withData(Data $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    /**
     * The timestamp of when the event occurred.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $obj = clone $this;
        $obj->timestamp = $timestamp;

        return $obj;
    }

    /**
     * The event type.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }
}
