<?php

declare(strict_types=1);

namespace Dodopayments\Refunds;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

final class Refund implements BaseModel
{
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

    /**
     * If true the refund is a partial refund.
     */
    #[Api('is_partial')]
    public bool $isPartial;

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

    /**
     * The current status of the refund.
     *
     * @var RefundStatus::* $status
     */
    #[Api(enum: RefundStatus::class)]
    public string $status;

    /**
     * The refunded amount.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $amount;

    /**
     * The currency of the refund, represented as an ISO 4217 currency code.
     *
     * @var Currency::*|null $currency
     */
    #[Api(enum: Currency::class, nullable: true, optional: true)]
    public ?string $currency;

    /**
     * The reason provided for the refund, if any. Optional.
     */
    #[Api(nullable: true, optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param RefundStatus::* $status
     * @param Currency::* $currency
     */
    public static function with(
        string $businessID,
        \DateTimeInterface $createdAt,
        bool $isPartial,
        string $paymentID,
        string $refundID,
        string $status,
        ?int $amount = null,
        ?string $currency = null,
        ?string $reason = null,
    ): self {
        $obj = new self;

        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->isPartial = $isPartial;
        $obj->paymentID = $paymentID;
        $obj->refundID = $refundID;
        $obj->status = $status;

        null !== $amount && $obj->amount = $amount;
        null !== $currency && $obj->currency = $currency;
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
     * The current status of the refund.
     *
     * @param RefundStatus::* $status
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

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
     * The currency of the refund, represented as an ISO 4217 currency code.
     *
     * @param Currency::* $currency
     */
    public function withCurrency(string $currency): self
    {
        $obj = clone $this;
        $obj->currency = $currency;

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
}
