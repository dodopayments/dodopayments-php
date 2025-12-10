<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Refunds\RefundStatus;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Refund\PayloadType;

/**
 * @phpstan-type RefundShape = array{
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   customer: CustomerLimitedDetails,
 *   isPartial: bool,
 *   metadata: array<string,string>,
 *   paymentID: string,
 *   refundID: string,
 *   status: value-of<RefundStatus>,
 *   amount?: int|null,
 *   currency?: value-of<Currency>|null,
 *   reason?: string|null,
 *   payloadType: value-of<PayloadType>,
 * }
 */
final class Refund implements BaseModel
{
    /** @use SdkModel<RefundShape> */
    use SdkModel;

    /**
     * The unique identifier of the business issuing the refund.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * The timestamp of when the refund was created in UTC.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required]
    public CustomerLimitedDetails $customer;

    /**
     * If true the refund is a partial refund.
     */
    #[Required('is_partial')]
    public bool $isPartial;

    /**
     * Additional metadata stored with the refund.
     *
     * @var array<string,string> $metadata
     */
    #[Required(map: 'string')]
    public array $metadata;

    /**
     * The unique identifier of the payment associated with the refund.
     */
    #[Required('payment_id')]
    public string $paymentID;

    /**
     * The unique identifier of the refund.
     */
    #[Required('refund_id')]
    public string $refundID;

    /** @var value-of<RefundStatus> $status */
    #[Required(enum: RefundStatus::class)]
    public string $status;

    /**
     * The refunded amount.
     */
    #[Optional(nullable: true)]
    public ?int $amount;

    /** @var value-of<Currency>|null $currency */
    #[Optional(enum: Currency::class)]
    public ?string $currency;

    /**
     * The reason provided for the refund, if any. Optional.
     */
    #[Optional(nullable: true)]
    public ?string $reason;

    /** @var value-of<PayloadType> $payloadType */
    #[Required('payload_type', enum: PayloadType::class)]
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
     * @param CustomerLimitedDetails|array{
     *   customerID: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phoneNumber?: string|null,
     * } $customer
     * @param array<string,string> $metadata
     * @param RefundStatus|value-of<RefundStatus> $status
     * @param PayloadType|value-of<PayloadType> $payloadType
     * @param Currency|value-of<Currency> $currency
     */
    public static function with(
        string $businessID,
        \DateTimeInterface $createdAt,
        CustomerLimitedDetails|array $customer,
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
        $self = new self;

        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['customer'] = $customer;
        $self['isPartial'] = $isPartial;
        $self['metadata'] = $metadata;
        $self['paymentID'] = $paymentID;
        $self['refundID'] = $refundID;
        $self['status'] = $status;
        $self['payloadType'] = $payloadType;

        null !== $amount && $self['amount'] = $amount;
        null !== $currency && $self['currency'] = $currency;
        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    /**
     * The unique identifier of the business issuing the refund.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * The timestamp of when the refund was created in UTC.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * @param CustomerLimitedDetails|array{
     *   customerID: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phoneNumber?: string|null,
     * } $customer
     */
    public function withCustomer(CustomerLimitedDetails|array $customer): self
    {
        $self = clone $this;
        $self['customer'] = $customer;

        return $self;
    }

    /**
     * If true the refund is a partial refund.
     */
    public function withIsPartial(bool $isPartial): self
    {
        $self = clone $this;
        $self['isPartial'] = $isPartial;

        return $self;
    }

    /**
     * Additional metadata stored with the refund.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * The unique identifier of the payment associated with the refund.
     */
    public function withPaymentID(string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    /**
     * The unique identifier of the refund.
     */
    public function withRefundID(string $refundID): self
    {
        $self = clone $this;
        $self['refundID'] = $refundID;

        return $self;
    }

    /**
     * @param RefundStatus|value-of<RefundStatus> $status
     */
    public function withStatus(RefundStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The refunded amount.
     */
    public function withAmount(?int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The reason provided for the refund, if any. Optional.
     */
    public function withReason(?string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public function withPayloadType(PayloadType|string $payloadType): self
    {
        $self = clone $this;
        $self['payloadType'] = $payloadType;

        return $self;
    }
}
