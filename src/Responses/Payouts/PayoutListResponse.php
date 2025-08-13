<?php

declare(strict_types=1);

namespace Dodopayments\Responses\Payouts;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
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
    use Model;

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
    public static function from(
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
    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * The unique identifier of the business associated with the payout.
     */
    public function setBusinessID(string $businessID): self
    {
        $this->businessID = $businessID;

        return $this;
    }

    /**
     * The total value of chargebacks associated with the payout.
     */
    public function setChargebacks(int $chargebacks): self
    {
        $this->chargebacks = $chargebacks;

        return $this;
    }

    /**
     * The timestamp when the payout was created, in UTC.
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * The currency of the payout, represented as an ISO 4217 currency code.
     *
     * @param Currency::* $currency
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * The fee charged for processing the payout.
     */
    public function setFee(int $fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * The payment method used for the payout (e.g., bank transfer, card, etc.).
     */
    public function setPaymentMethod(string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * The unique identifier of the payout.
     */
    public function setPayoutID(string $payoutID): self
    {
        $this->payoutID = $payoutID;

        return $this;
    }

    /**
     * The total value of refunds associated with the payout.
     */
    public function setRefunds(int $refunds): self
    {
        $this->refunds = $refunds;

        return $this;
    }

    /**
     * The current status of the payout.
     *
     * @param Status::* $status
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * The tax applied to the payout.
     */
    public function setTax(int $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * The timestamp when the payout was last updated, in UTC.
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * The name of the payout recipient or purpose.
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * The URL of the document associated with the payout.
     */
    public function setPayoutDocumentURL(?string $payoutDocumentURL): self
    {
        $this->payoutDocumentURL = $payoutDocumentURL;

        return $this;
    }

    /**
     * Any additional remarks or notes associated with the payout.
     */
    public function setRemarks(?string $remarks): self
    {
        $this->remarks = $remarks;

        return $this;
    }
}
