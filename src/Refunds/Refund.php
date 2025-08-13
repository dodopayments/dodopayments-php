<?php

declare(strict_types=1);

namespace Dodopayments\Refunds;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type refund_alias = array{
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   isPartial: bool,
 *   paymentID: string,
 *   refundID: string,
 *   status: RefundStatus::*,
 *   amount?: int|null,
 *   currency?: Currency::*,
 *   reason?: string|null,
 * }
 */
final class Refund implements BaseModel
{
    use Model;

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
    #[Api(optional: true)]
    public ?int $amount;

    /**
     * The currency of the refund, represented as an ISO 4217 currency code.
     *
     * @var null|Currency::* $currency
     */
    #[Api(enum: Currency::class, optional: true)]
    public ?string $currency;

    /**
     * The reason provided for the refund, if any. Optional.
     */
    #[Api(optional: true)]
    public ?string $reason;

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
    public static function from(
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
    public function setBusinessID(string $businessID): self
    {
        $this->businessID = $businessID;

        return $this;
    }

    /**
     * The timestamp of when the refund was created in UTC.
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * If true the refund is a partial refund.
     */
    public function setIsPartial(bool $isPartial): self
    {
        $this->isPartial = $isPartial;

        return $this;
    }

    /**
     * The unique identifier of the payment associated with the refund.
     */
    public function setPaymentID(string $paymentID): self
    {
        $this->paymentID = $paymentID;

        return $this;
    }

    /**
     * The unique identifier of the refund.
     */
    public function setRefundID(string $refundID): self
    {
        $this->refundID = $refundID;

        return $this;
    }

    /**
     * The current status of the refund.
     *
     * @param RefundStatus::* $status
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * The refunded amount.
     */
    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * The currency of the refund, represented as an ISO 4217 currency code.
     *
     * @param Currency::* $currency
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * The reason provided for the refund, if any. Optional.
     */
    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }
}
