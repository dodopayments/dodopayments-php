<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Refunds\RefundStatus;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Refund\PayloadType;

/**
 * @phpstan-type refund_alias = array{
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   customer: CustomerLimitedDetails,
 *   isPartial: bool,
 *   metadata: array<string, string>,
 *   paymentID: string,
 *   refundID: string,
 *   status: value-of<RefundStatus>,
 *   amount?: int|null,
 *   currency?: value-of<Currency>,
 *   reason?: string|null,
 *   payloadType: value-of<PayloadType>,
 * }
 */
final class Refund implements BaseModel
{
    /** @use SdkModel<refund_alias> */
    use SdkModel;

    /**
     * The unique identifier of the business issuing the refund.
     */
    #[Api('business_id')]
    public string $businessID;

    /**
     * The timestamp of when the refund was created in UTC.
     */
    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    #[Api]
    public CustomerLimitedDetails $customer;

    /**
     * If true the refund is a partial refund.
     */
    #[Api('is_partial')]
    public bool $isPartial;

    /**
     * Additional metadata stored with the refund.
     *
     * @var array<string, string> $metadata
     */
    #[Api(map: 'string')]
    public array $metadata;

    /**
     * The unique identifier of the payment associated with the refund.
     */
    #[Api('payment_id')]
    public string $paymentID;

    /**
     * The unique identifier of the refund.
     */
    #[Api('refund_id')]
    public string $refundID;

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

    /** @var value-of<PayloadType> $payloadType */
    #[Api('payload_type', enum: PayloadType::class)]
    public string $payloadType;

    /**
     * `new Refund()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Refund::with(
     *   businessID: ...,
     *   createdAt: ...,
     *   customer: ...,
     *   isPartial: ...,
     *   metadata: ...,
     *   paymentID: ...,
     *   refundID: ...,
     *   status: ...,
     *   payloadType: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Refund)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCustomer(...)
     *   ->withIsPartial(...)
     *   ->withMetadata(...)
     *   ->withPaymentID(...)
     *   ->withRefundID(...)
     *   ->withStatus(...)
     *   ->withPayloadType(...)
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
     * @param array<string, string> $metadata
     * @param RefundStatus|value-of<RefundStatus> $status
     * @param PayloadType|value-of<PayloadType> $payloadType
     * @param Currency|value-of<Currency> $currency
     */
    public static function with(
        string $businessID,
        \DateTimeInterface $createdAt,
        CustomerLimitedDetails $customer,
        bool $isPartial,
        array $metadata,
        string $paymentID,
        string $refundID,
        RefundStatus|string $status,
        PayloadType|string $payloadType,
        ?int $amount = null,
        Currency|string|null $currency = null,
        ?string $reason = null,
    ): self {
        $obj = new self;

        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->customer = $customer;
        $obj->isPartial = $isPartial;
        $obj->metadata = $metadata;
        $obj->paymentID = $paymentID;
        $obj->refundID = $refundID;
        $obj['status'] = $status;
        $obj['payloadType'] = $payloadType;

        null !== $amount && $obj->amount = $amount;
        null !== $currency && $obj['currency'] = $currency;
        null !== $reason && $obj->reason = $reason;

        return $obj;
    }

    /**
     * The unique identifier of the business issuing the refund.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    /**
     * The timestamp of when the refund was created in UTC.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    public function withCustomer(CustomerLimitedDetails $customer): self
    {
        $obj = clone $this;
        $obj->customer = $customer;

        return $obj;
    }

    /**
     * If true the refund is a partial refund.
     */
    public function withIsPartial(bool $isPartial): self
    {
        $obj = clone $this;
        $obj->isPartial = $isPartial;

        return $obj;
    }

    /**
     * Additional metadata stored with the refund.
     *
     * @param array<string, string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * The unique identifier of the payment associated with the refund.
     */
    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj->paymentID = $paymentID;

        return $obj;
    }

    /**
     * The unique identifier of the refund.
     */
    public function withRefundID(string $refundID): self
    {
        $obj = clone $this;
        $obj->refundID = $refundID;

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
        $obj->amount = $amount;

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
        $obj->reason = $reason;

        return $obj;
    }

    /**
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public function withPayloadType(PayloadType|string $payloadType): self
    {
        $obj = clone $this;
        $obj['payloadType'] = $payloadType;

        return $obj;
    }
}
