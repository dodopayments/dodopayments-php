<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Refunds\RefundStatus;
use Dodopayments\Webhooks\RefundFailedWebhookEvent\Data;
use Dodopayments\Webhooks\RefundFailedWebhookEvent\Data\PayloadType;
use Dodopayments\Webhooks\RefundFailedWebhookEvent\Type;

/**
 * @phpstan-type RefundFailedWebhookEventShape = array{
 *   business_id: string,
 *   data: Data,
 *   timestamp: \DateTimeInterface,
 *   type: value-of<Type>,
 * }
 */
final class RefundFailedWebhookEvent implements BaseModel
{
    /** @use SdkModel<RefundFailedWebhookEventShape> */
    use SdkModel;

    /**
     * The business identifier.
     */
    #[Required]
    public string $business_id;

    /**
     * Event-specific data.
     */
    #[Required]
    public Data $data;

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
     * `new RefundFailedWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RefundFailedWebhookEvent::with(
     *   business_id: ..., data: ..., timestamp: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RefundFailedWebhookEvent)
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
     * @param Data|array{
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   customer: CustomerLimitedDetails,
     *   is_partial: bool,
     *   metadata: array<string,string>,
     *   payment_id: string,
     *   refund_id: string,
     *   status: value-of<RefundStatus>,
     *   amount?: int|null,
     *   currency?: value-of<Currency>|null,
     *   reason?: string|null,
     *   payload_type?: value-of<PayloadType>|null,
     * } $data
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $business_id,
        Data|array $data,
        \DateTimeInterface $timestamp,
        Type|string $type,
    ): self {
        $obj = new self;

        $obj['business_id'] = $business_id;
        $obj['data'] = $data;
        $obj['timestamp'] = $timestamp;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * The business identifier.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['business_id'] = $businessID;

        return $obj;
    }

    /**
     * Event-specific data.
     *
     * @param Data|array{
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   customer: CustomerLimitedDetails,
     *   is_partial: bool,
     *   metadata: array<string,string>,
     *   payment_id: string,
     *   refund_id: string,
     *   status: value-of<RefundStatus>,
     *   amount?: int|null,
     *   currency?: value-of<Currency>|null,
     *   reason?: string|null,
     *   payload_type?: value-of<PayloadType>|null,
     * } $data
     */
    public function withData(Data|array $data): self
    {
        $obj = clone $this;
        $obj['data'] = $data;

        return $obj;
    }

    /**
     * The timestamp of when the event occurred.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $obj = clone $this;
        $obj['timestamp'] = $timestamp;

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
