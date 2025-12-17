<?php

declare(strict_types=1);

namespace Dodopayments\Payouts;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payouts\PayoutListResponse\Status;

/**
 * @phpstan-type PayoutListResponseShape = array{
 *   amount: int,
 *   businessID: string,
 *   chargebacks: int,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency|value-of<Currency>,
 *   fee: int,
 *   paymentMethod: string,
 *   payoutID: string,
 *   refunds: int,
 *   status: Status|value-of<Status>,
 *   tax: int,
 *   updatedAt: \DateTimeInterface,
 *   name?: string|null,
 *   payoutDocumentURL?: string|null,
 *   remarks?: string|null,
 * }
 */
final class PayoutListResponse implements BaseModel
{
    /** @use SdkModel<PayoutListResponseShape> */
    use SdkModel;

    /**
     * The total amount of the payout.
     */
    #[Required]
    public int $amount;

    /**
     * The unique identifier of the business associated with the payout.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * @deprecated
     *
     * The total value of chargebacks associated with the payout
     */
    #[Required]
    public int $chargebacks;

    /**
     * The timestamp when the payout was created, in UTC.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The currency of the payout, represented as an ISO 4217 currency code.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The fee charged for processing the payout.
     */
    #[Required]
    public int $fee;

    /**
     * The payment method used for the payout (e.g., bank transfer, card, etc.).
     */
    #[Required('payment_method')]
    public string $paymentMethod;

    /**
     * The unique identifier of the payout.
     */
    #[Required('payout_id')]
    public string $payoutID;

    /**
     * @deprecated
     *
     * The total value of refunds associated with the payout
     */
    #[Required]
    public int $refunds;

    /**
     * The current status of the payout.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * @deprecated
     *
     * The tax applied to the payout
     */
    #[Required]
    public int $tax;

    /**
     * The timestamp when the payout was last updated, in UTC.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * The name of the payout recipient or purpose.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * The URL of the document associated with the payout.
     */
    #[Optional('payout_document_url', nullable: true)]
    public ?string $payoutDocumentURL;

    /**
     * Any additional remarks or notes associated with the payout.
     */
    #[Optional(nullable: true)]
    public ?string $remarks;

    /**
     * `new PayoutListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PayoutListResponse::with(
     *   amount: ...,
     *   businessID: ...,
     *   chargebacks: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   fee: ...,
     *   paymentMethod: ...,
     *   payoutID: ...,
     *   refunds: ...,
     *   status: ...,
     *   tax: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PayoutListResponse)
     *   ->withAmount(...)
     *   ->withBusinessID(...)
     *   ->withChargebacks(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withFee(...)
     *   ->withPaymentMethod(...)
     *   ->withPayoutID(...)
     *   ->withRefunds(...)
     *   ->withStatus(...)
     *   ->withTax(...)
     *   ->withUpdatedAt(...)
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
     * @param Currency|value-of<Currency> $currency
     * @param Status|value-of<Status> $status
     */
    public static function with(
        int $amount,
        string $businessID,
        int $chargebacks,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        int $fee,
        string $paymentMethod,
        string $payoutID,
        int $refunds,
        Status|string $status,
        int $tax,
        \DateTimeInterface $updatedAt,
        ?string $name = null,
        ?string $payoutDocumentURL = null,
        ?string $remarks = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['businessID'] = $businessID;
        $self['chargebacks'] = $chargebacks;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['fee'] = $fee;
        $self['paymentMethod'] = $paymentMethod;
        $self['payoutID'] = $payoutID;
        $self['refunds'] = $refunds;
        $self['status'] = $status;
        $self['tax'] = $tax;
        $self['updatedAt'] = $updatedAt;

        null !== $name && $self['name'] = $name;
        null !== $payoutDocumentURL && $self['payoutDocumentURL'] = $payoutDocumentURL;
        null !== $remarks && $self['remarks'] = $remarks;

        return $self;
    }

    /**
     * The total amount of the payout.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The unique identifier of the business associated with the payout.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * The total value of chargebacks associated with the payout.
     */
    public function withChargebacks(int $chargebacks): self
    {
        $self = clone $this;
        $self['chargebacks'] = $chargebacks;

        return $self;
    }

    /**
     * The timestamp when the payout was created, in UTC.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The currency of the payout, represented as an ISO 4217 currency code.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The fee charged for processing the payout.
     */
    public function withFee(int $fee): self
    {
        $self = clone $this;
        $self['fee'] = $fee;

        return $self;
    }

    /**
     * The payment method used for the payout (e.g., bank transfer, card, etc.).
     */
    public function withPaymentMethod(string $paymentMethod): self
    {
        $self = clone $this;
        $self['paymentMethod'] = $paymentMethod;

        return $self;
    }

    /**
     * The unique identifier of the payout.
     */
    public function withPayoutID(string $payoutID): self
    {
        $self = clone $this;
        $self['payoutID'] = $payoutID;

        return $self;
    }

    /**
     * The total value of refunds associated with the payout.
     */
    public function withRefunds(int $refunds): self
    {
        $self = clone $this;
        $self['refunds'] = $refunds;

        return $self;
    }

    /**
     * The current status of the payout.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The tax applied to the payout.
     */
    public function withTax(int $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }

    /**
     * The timestamp when the payout was last updated, in UTC.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * The name of the payout recipient or purpose.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The URL of the document associated with the payout.
     */
    public function withPayoutDocumentURL(?string $payoutDocumentURL): self
    {
        $self = clone $this;
        $self['payoutDocumentURL'] = $payoutDocumentURL;

        return $self;
    }

    /**
     * Any additional remarks or notes associated with the payout.
     */
    public function withRemarks(?string $remarks): self
    {
        $self = clone $this;
        $self['remarks'] = $remarks;

        return $self;
    }
}
