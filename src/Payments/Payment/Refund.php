<?php

declare(strict_types=1);

namespace Dodopayments\Payments\Payment;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Refunds\RefundStatus;

/**
 * @phpstan-type RefundShape = array{
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   isPartial: bool,
 *   paymentID: string,
 *   refundID: string,
 *   status: RefundStatus|value-of<RefundStatus>,
 *   amount?: int|null,
 *   currency?: null|Currency|value-of<Currency>,
 *   reason?: string|null,
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

    /**
     * If true the refund is a partial refund.
     */
    #[Required('is_partial')]
    public bool $isPartial;

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

    /**
     * The current status of the refund.
     *
     * @var value-of<RefundStatus> $status
     */
    #[Required(enum: RefundStatus::class)]
    public string $status;

    /**
     * The refunded amount.
     */
    #[Optional(nullable: true)]
    public ?int $amount;

    /**
     * The currency of the refund, represented as an ISO 4217 currency code.
     *
     * @var value-of<Currency>|null $currency
     */
    #[Optional(enum: Currency::class, nullable: true)]
    public ?string $currency;

    /**
     * The reason provided for the refund, if any. Optional.
     */
    #[Optional(nullable: true)]
    public ?string $reason;

    /**
     * `new Refund()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Refund::with(
     *   businessID: ...,
     *   createdAt: ...,
     *   isPartial: ...,
     *   paymentID: ...,
     *   refundID: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Refund)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withIsPartial(...)
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
     * @param RefundStatus|value-of<RefundStatus> $status
     * @param Currency|value-of<Currency>|null $currency
     */
    public static function with(
        string $businessID,
        \DateTimeInterface $createdAt,
        bool $isPartial,
        string $paymentID,
        string $refundID,
        RefundStatus|string $status,
        ?int $amount = null,
        Currency|string|null $currency = null,
        ?string $reason = null,
    ): self {
        $self = new self;

        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['isPartial'] = $isPartial;
        $self['paymentID'] = $paymentID;
        $self['refundID'] = $refundID;
        $self['status'] = $status;

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
     * If true the refund is a partial refund.
     */
    public function withIsPartial(bool $isPartial): self
    {
        $self = clone $this;
        $self['isPartial'] = $isPartial;

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
     * The current status of the refund.
     *
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
     * The currency of the refund, represented as an ISO 4217 currency code.
     *
     * @param Currency|value-of<Currency>|null $currency
     */
    public function withCurrency(Currency|string|null $currency): self
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
}
