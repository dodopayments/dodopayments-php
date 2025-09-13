<?php

declare(strict_types=1);

namespace Dodopayments\Refunds;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\CustomerLimitedDetails;

/**
 * @phpstan-type refund_alias = array{
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   customer: CustomerLimitedDetails,
 *   isPartial: bool,
 *   paymentID: string,
 *   refundID: string,
 *   status: value-of<RefundStatus>,
 *   amount?: int|null,
 *   currency?: value-of<Currency>|null,
 *   reason?: string|null,
 * }
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
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

    /**
     * Details about the customer for this refund (from the associated payment).
     */
    #[Api]
    public CustomerLimitedDetails $customer;

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
     *   businessID: ...,
     *   createdAt: ...,
     *   customer: ...,
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
     *   ->withCustomer(...)
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
        CustomerLimitedDetails $customer,
        bool $isPartial,
        string $paymentID,
        string $refundID,
        RefundStatus|string $status,
        ?int $amount = null,
        Currency|string|null $currency = null,
        ?string $reason = null,
    ): self {
        $obj = new self;

        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->customer = $customer;
        $obj->isPartial = $isPartial;
        $obj->paymentID = $paymentID;
        $obj->refundID = $refundID;
        $obj->status = $status instanceof RefundStatus ? $status->value : $status;

        null !== $amount && $obj->amount = $amount;
        null !== $currency && $obj->currency = $currency instanceof Currency ? $currency->value : $currency;
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
     * Details about the customer for this refund (from the associated payment).
     */
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
     * @param RefundStatus|value-of<RefundStatus> $status
     */
    public function withStatus(RefundStatus|string $status): self
    {
        $obj = clone $this;
        $obj->status = $status instanceof RefundStatus ? $status->value : $status;

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
        $obj->currency = $currency instanceof Currency ? $currency->value : $currency;

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
