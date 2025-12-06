<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\RefundSucceededWebhookEvent;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Refunds\RefundStatus;
use Dodopayments\Webhooks\RefundSucceededWebhookEvent\Data\PayloadType;

/**
 * Event-specific data.
 *
 * @phpstan-type DataShape = array{
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
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * The unique identifier of the business issuing the refund.
     */
    #[Api]
    public string $business_id;

    /**
     * The timestamp of when the refund was created in UTC.
     */
    #[Api]
    public \DateTimeInterface $created_at;

    #[Api]
    public CustomerLimitedDetails $customer;

    /**
     * If true the refund is a partial refund.
     */
    #[Api]
    public bool $is_partial;

    /**
     * Additional metadata stored with the refund.
     *
     * @var array<string,string> $metadata
     */
    #[Api(map: 'string')]
    public array $metadata;

    /**
     * The unique identifier of the payment associated with the refund.
     */
    #[Api]
    public string $payment_id;

    /**
     * The unique identifier of the refund.
     */
    #[Api]
    public string $refund_id;

    /** @var value-of<RefundStatus> $status */
    #[Api(enum: RefundStatus::class)]
    public string $status;

    /**
     * The refunded amount.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $amount;

    /** @var value-of<Currency>|null $currency */
    #[Api(enum: Currency::class, optional: true)]
    public ?string $currency;

    /**
     * The reason provided for the refund, if any. Optional.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $reason;

    /**
     * The type of payload in the data field.
     *
     * @var value-of<PayloadType>|null $payload_type
     */
    #[Api(enum: PayloadType::class, optional: true)]
    public ?string $payload_type;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   business_id: ...,
     *   created_at: ...,
     *   customer: ...,
     *   is_partial: ...,
     *   metadata: ...,
     *   payment_id: ...,
     *   refund_id: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCustomer(...)
     *   ->withIsPartial(...)
     *   ->withMetadata(...)
     *   ->withPaymentID(...)
     *   ->withRefundID(...)
     *   ->withStatus(...)
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
     * @param CustomerLimitedDetails|array{
     *   customer_id: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phone_number?: string|null,
     * } $customer
     * @param array<string,string> $metadata
     * @param RefundStatus|value-of<RefundStatus> $status
     * @param Currency|value-of<Currency> $currency
     * @param PayloadType|value-of<PayloadType> $payload_type
     */
    public static function with(
        string $business_id,
        \DateTimeInterface $created_at,
        CustomerLimitedDetails|array $customer,
        bool $is_partial,
        array $metadata,
        string $payment_id,
        string $refund_id,
        RefundStatus|string $status,
        ?int $amount = null,
        Currency|string|null $currency = null,
        ?string $reason = null,
        PayloadType|string|null $payload_type = null,
    ): self {
        $obj = new self;

        $obj['business_id'] = $business_id;
        $obj['created_at'] = $created_at;
        $obj['customer'] = $customer;
        $obj['is_partial'] = $is_partial;
        $obj['metadata'] = $metadata;
        $obj['payment_id'] = $payment_id;
        $obj['refund_id'] = $refund_id;
        $obj['status'] = $status;

        null !== $amount && $obj['amount'] = $amount;
        null !== $currency && $obj['currency'] = $currency;
        null !== $reason && $obj['reason'] = $reason;
        null !== $payload_type && $obj['payload_type'] = $payload_type;

        return $obj;
    }

    /**
     * The unique identifier of the business issuing the refund.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['business_id'] = $businessID;

        return $obj;
    }

    /**
     * The timestamp of when the refund was created in UTC.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * @param CustomerLimitedDetails|array{
     *   customer_id: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phone_number?: string|null,
     * } $customer
     */
    public function withCustomer(CustomerLimitedDetails|array $customer): self
    {
        $obj = clone $this;
        $obj['customer'] = $customer;

        return $obj;
    }

    /**
     * If true the refund is a partial refund.
     */
    public function withIsPartial(bool $isPartial): self
    {
        $obj = clone $this;
        $obj['is_partial'] = $isPartial;

        return $obj;
    }

    /**
     * Additional metadata stored with the refund.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * The unique identifier of the payment associated with the refund.
     */
    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj['payment_id'] = $paymentID;

        return $obj;
    }

    /**
     * The unique identifier of the refund.
     */
    public function withRefundID(string $refundID): self
    {
        $obj = clone $this;
        $obj['refund_id'] = $refundID;

        return $obj;
    }

    /**
     * @param RefundStatus|value-of<RefundStatus> $status
     */
    public function withStatus(RefundStatus|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * The refunded amount.
     */
    public function withAmount(?int $amount): self
    {
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    /**
     * The reason provided for the refund, if any. Optional.
     */
    public function withReason(?string $reason): self
    {
        $obj = clone $this;
        $obj['reason'] = $reason;

        return $obj;
    }

    /**
     * The type of payload in the data field.
     *
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public function withPayloadType(PayloadType|string $payloadType): self
    {
        $obj = clone $this;
        $obj['payload_type'] = $payloadType;

        return $obj;
    }
}
