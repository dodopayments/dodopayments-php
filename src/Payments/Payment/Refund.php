<?php

declare(strict_types=1);

namespace Dodopayments\Payments\Payment;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Refunds\RefundStatus;

/**
 * @phpstan-type RefundShape = array{
 *   business_id: string,
 *   created_at: \DateTimeInterface,
 *   is_partial: bool,
 *   payment_id: string,
 *   refund_id: string,
 *   status: value-of<RefundStatus>,
 *   amount?: int|null,
 *   currency?: value-of<Currency>|null,
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
    #[Api]
    public string $business_id;

    /**
     * The timestamp of when the refund was created in UTC.
     */
    #[Api]
    public \DateTimeInterface $created_at;

    /**
     * If true the refund is a partial refund.
     */
    #[Api]
    public bool $is_partial;

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

    /**
     * The current status of the refund.
     *
     * @var value-of<RefundStatus> $status
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
     * @var value-of<Currency>|null $currency
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
     *   business_id: ...,
     *   created_at: ...,
     *   is_partial: ...,
     *   payment_id: ...,
     *   refund_id: ...,
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
        string $business_id,
        \DateTimeInterface $created_at,
        bool $is_partial,
        string $payment_id,
        string $refund_id,
        RefundStatus|string $status,
        ?int $amount = null,
        Currency|string|null $currency = null,
        ?string $reason = null,
    ): self {
        $obj = new self;

        $obj->business_id = $business_id;
        $obj->created_at = $created_at;
        $obj->is_partial = $is_partial;
        $obj->payment_id = $payment_id;
        $obj->refund_id = $refund_id;
        $obj['status'] = $status;

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
        $obj->business_id = $businessID;

        return $obj;
    }

    /**
     * The timestamp of when the refund was created in UTC.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->created_at = $createdAt;

        return $obj;
    }

    /**
     * If true the refund is a partial refund.
     */
    public function withIsPartial(bool $isPartial): self
    {
        $obj = clone $this;
        $obj->is_partial = $isPartial;

        return $obj;
    }

    /**
     * The unique identifier of the payment associated with the refund.
     */
    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj->payment_id = $paymentID;

        return $obj;
    }

    /**
     * The unique identifier of the refund.
     */
    public function withRefundID(string $refundID): self
    {
        $obj = clone $this;
        $obj->refund_id = $refundID;

        return $obj;
    }

    /**
     * The current status of the refund.
     *
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
     * The currency of the refund, represented as an ISO 4217 currency code.
     *
     * @param Currency|value-of<Currency>|null $currency
     */
    public function withCurrency(Currency|string|null $currency): self
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
}
