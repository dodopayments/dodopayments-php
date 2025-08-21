<?php

declare(strict_types=1);

namespace Dodopayments\Responses\Payouts;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Responses\Payouts\PayoutListResponse\Status;

/**
 * @phpstan-type payout_list_response_alias = array{
 *   amount: int,
 *   businessID: string,
 *   chargebacks: int,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency::*,
 *   fee: int,
 *   paymentMethod: string,
 *   payoutID: string,
 *   refunds: int,
 *   status: Status::*,
 *   tax: int,
 *   updatedAt: \DateTimeInterface,
 *   name?: string|null,
 *   payoutDocumentURL?: string|null,
 *   remarks?: string|null,
 * }
 */
final class PayoutListResponse implements BaseModel
{
    use SdkModel;

    /**
     * The total amount of the payout.
     */
    #[Api]
    public int $amount;

    /**
     * The unique identifier of the business associated with the payout.
     */
    #[Api('business_id')]
    public string $businessID;

    /**
     * The total value of chargebacks associated with the payout.
     */
    #[Api]
    public int $chargebacks;

    /**
     * The timestamp when the payout was created, in UTC.
     */
    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The currency of the payout, represented as an ISO 4217 currency code.
     *
     * @var Currency::* $currency
     */
    #[Api(enum: Currency::class)]
    public string $currency;

    /**
     * The fee charged for processing the payout.
     */
    #[Api]
    public int $fee;

    /**
     * The payment method used for the payout (e.g., bank transfer, card, etc.).
     */
    #[Api('payment_method')]
    public string $paymentMethod;

    /**
     * The unique identifier of the payout.
     */
    #[Api('payout_id')]
    public string $payoutID;

    /**
     * The total value of refunds associated with the payout.
     */
    #[Api]
    public int $refunds;

    /**
     * The current status of the payout.
     *
     * @var Status::* $status
     */
    #[Api(enum: Status::class)]
    public string $status;

    /**
     * The tax applied to the payout.
     */
    #[Api]
    public int $tax;

    /**
     * The timestamp when the payout was last updated, in UTC.
     */
    #[Api('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * The name of the payout recipient or purpose.
     */
    #[Api(optional: true)]
    public ?string $name;

    /**
     * The URL of the document associated with the payout.
     */
    #[Api('payout_document_url', optional: true)]
    public ?string $payoutDocumentURL;

    /**
     * Any additional remarks or notes associated with the payout.
     */
    #[Api(optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Currency::* $currency
     * @param Status::* $status
     */
    public static function with(
        int $amount,
        string $businessID,
        int $chargebacks,
        \DateTimeInterface $createdAt,
        string $currency,
        int $fee,
        string $paymentMethod,
        string $payoutID,
        int $refunds,
        string $status,
        int $tax,
        \DateTimeInterface $updatedAt,
        ?string $name = null,
        ?string $payoutDocumentURL = null,
        ?string $remarks = null,
    ): self {
        $obj = new self;

        $obj->amount = $amount;
        $obj->businessID = $businessID;
        $obj->chargebacks = $chargebacks;
        $obj->createdAt = $createdAt;
        $obj->currency = $currency;
        $obj->fee = $fee;
        $obj->paymentMethod = $paymentMethod;
        $obj->payoutID = $payoutID;
        $obj->refunds = $refunds;
        $obj->status = $status;
        $obj->tax = $tax;
        $obj->updatedAt = $updatedAt;

        null !== $name && $obj->name = $name;
        null !== $payoutDocumentURL && $obj->payoutDocumentURL = $payoutDocumentURL;
        null !== $remarks && $obj->remarks = $remarks;

        return $obj;
    }

    /**
     * The total amount of the payout.
     */
    public function withAmount(int $amount): self
    {
        $obj = clone $this;
        $obj->amount = $amount;

        return $obj;
    }

    /**
     * The unique identifier of the business associated with the payout.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    /**
     * The total value of chargebacks associated with the payout.
     */
    public function withChargebacks(int $chargebacks): self
    {
        $obj = clone $this;
        $obj->chargebacks = $chargebacks;

        return $obj;
    }

    /**
     * The timestamp when the payout was created, in UTC.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * The currency of the payout, represented as an ISO 4217 currency code.
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
     * The fee charged for processing the payout.
     */
    public function withFee(int $fee): self
    {
        $obj = clone $this;
        $obj->fee = $fee;

        return $obj;
    }

    /**
     * The payment method used for the payout (e.g., bank transfer, card, etc.).
     */
    public function withPaymentMethod(string $paymentMethod): self
    {
        $obj = clone $this;
        $obj->paymentMethod = $paymentMethod;

        return $obj;
    }

    /**
     * The unique identifier of the payout.
     */
    public function withPayoutID(string $payoutID): self
    {
        $obj = clone $this;
        $obj->payoutID = $payoutID;

        return $obj;
    }

    /**
     * The total value of refunds associated with the payout.
     */
    public function withRefunds(int $refunds): self
    {
        $obj = clone $this;
        $obj->refunds = $refunds;

        return $obj;
    }

    /**
     * The current status of the payout.
     *
     * @param Status::* $status
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }

    /**
     * The tax applied to the payout.
     */
    public function withTax(int $tax): self
    {
        $obj = clone $this;
        $obj->tax = $tax;

        return $obj;
    }

    /**
     * The timestamp when the payout was last updated, in UTC.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj->updatedAt = $updatedAt;

        return $obj;
    }

    /**
     * The name of the payout recipient or purpose.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * The URL of the document associated with the payout.
     */
    public function withPayoutDocumentURL(?string $payoutDocumentURL): self
    {
        $obj = clone $this;
        $obj->payoutDocumentURL = $payoutDocumentURL;

        return $obj;
    }

    /**
     * Any additional remarks or notes associated with the payout.
     */
    public function withRemarks(?string $remarks): self
    {
        $obj = clone $this;
        $obj->remarks = $remarks;

        return $obj;
    }
}
