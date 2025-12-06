<?php

declare(strict_types=1);

namespace Dodopayments\Payouts;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;
use Dodopayments\Misc\Currency;
use Dodopayments\Payouts\PayoutListResponse\Status;

/**
 * @phpstan-type PayoutListResponseShape = array{
 *   amount: int,
 *   business_id: string,
 *   chargebacks: int,
 *   created_at: \DateTimeInterface,
 *   currency: value-of<Currency>,
 *   fee: int,
 *   payment_method: string,
 *   payout_id: string,
 *   refunds: int,
 *   status: value-of<Status>,
 *   tax: int,
 *   updated_at: \DateTimeInterface,
 *   name?: string|null,
 *   payout_document_url?: string|null,
 *   remarks?: string|null,
 * }
 */
final class PayoutListResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<PayoutListResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * The total amount of the payout.
     */
    #[Api]
    public int $amount;

    /**
     * The unique identifier of the business associated with the payout.
     */
    #[Api]
    public string $business_id;

    /**
     * @deprecated
     *
     * The total value of chargebacks associated with the payout
     */
    #[Api]
    public int $chargebacks;

    /**
     * The timestamp when the payout was created, in UTC.
     */
    #[Api]
    public \DateTimeInterface $created_at;

    /**
     * The currency of the payout, represented as an ISO 4217 currency code.
     *
     * @var value-of<Currency> $currency
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
    #[Api]
    public string $payment_method;

    /**
     * The unique identifier of the payout.
     */
    #[Api]
    public string $payout_id;

    /**
     * @deprecated
     *
     * The total value of refunds associated with the payout
     */
    #[Api]
    public int $refunds;

    /**
     * The current status of the payout.
     *
     * @var value-of<Status> $status
     */
    #[Api(enum: Status::class)]
    public string $status;

    /**
     * @deprecated
     *
     * The tax applied to the payout
     */
    #[Api]
    public int $tax;

    /**
     * The timestamp when the payout was last updated, in UTC.
     */
    #[Api]
    public \DateTimeInterface $updated_at;

    /**
     * The name of the payout recipient or purpose.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $name;

    /**
     * The URL of the document associated with the payout.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $payout_document_url;

    /**
     * Any additional remarks or notes associated with the payout.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $remarks;

    /**
     * `new PayoutListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PayoutListResponse::with(
     *   amount: ...,
     *   business_id: ...,
     *   chargebacks: ...,
     *   created_at: ...,
     *   currency: ...,
     *   fee: ...,
     *   payment_method: ...,
     *   payout_id: ...,
     *   refunds: ...,
     *   status: ...,
     *   tax: ...,
     *   updated_at: ...,
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
        string $business_id,
        int $chargebacks,
        \DateTimeInterface $created_at,
        Currency|string $currency,
        int $fee,
        string $payment_method,
        string $payout_id,
        int $refunds,
        Status|string $status,
        int $tax,
        \DateTimeInterface $updated_at,
        ?string $name = null,
        ?string $payout_document_url = null,
        ?string $remarks = null,
    ): self {
        $obj = new self;

        $obj['amount'] = $amount;
        $obj['business_id'] = $business_id;
        $obj['chargebacks'] = $chargebacks;
        $obj['created_at'] = $created_at;
        $obj['currency'] = $currency;
        $obj['fee'] = $fee;
        $obj['payment_method'] = $payment_method;
        $obj['payout_id'] = $payout_id;
        $obj['refunds'] = $refunds;
        $obj['status'] = $status;
        $obj['tax'] = $tax;
        $obj['updated_at'] = $updated_at;

        null !== $name && $obj['name'] = $name;
        null !== $payout_document_url && $obj['payout_document_url'] = $payout_document_url;
        null !== $remarks && $obj['remarks'] = $remarks;

        return $obj;
    }

    /**
     * The total amount of the payout.
     */
    public function withAmount(int $amount): self
    {
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }

    /**
     * The unique identifier of the business associated with the payout.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['business_id'] = $businessID;

        return $obj;
    }

    /**
     * The total value of chargebacks associated with the payout.
     */
    public function withChargebacks(int $chargebacks): self
    {
        $obj = clone $this;
        $obj['chargebacks'] = $chargebacks;

        return $obj;
    }

    /**
     * The timestamp when the payout was created, in UTC.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * The currency of the payout, represented as an ISO 4217 currency code.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    /**
     * The fee charged for processing the payout.
     */
    public function withFee(int $fee): self
    {
        $obj = clone $this;
        $obj['fee'] = $fee;

        return $obj;
    }

    /**
     * The payment method used for the payout (e.g., bank transfer, card, etc.).
     */
    public function withPaymentMethod(string $paymentMethod): self
    {
        $obj = clone $this;
        $obj['payment_method'] = $paymentMethod;

        return $obj;
    }

    /**
     * The unique identifier of the payout.
     */
    public function withPayoutID(string $payoutID): self
    {
        $obj = clone $this;
        $obj['payout_id'] = $payoutID;

        return $obj;
    }

    /**
     * The total value of refunds associated with the payout.
     */
    public function withRefunds(int $refunds): self
    {
        $obj = clone $this;
        $obj['refunds'] = $refunds;

        return $obj;
    }

    /**
     * The current status of the payout.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * The tax applied to the payout.
     */
    public function withTax(int $tax): self
    {
        $obj = clone $this;
        $obj['tax'] = $tax;

        return $obj;
    }

    /**
     * The timestamp when the payout was last updated, in UTC.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $obj = clone $this;
        $obj['updated_at'] = $updatedAt;

        return $obj;
    }

    /**
     * The name of the payout recipient or purpose.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * The URL of the document associated with the payout.
     */
    public function withPayoutDocumentURL(?string $payoutDocumentURL): self
    {
        $obj = clone $this;
        $obj['payout_document_url'] = $payoutDocumentURL;

        return $obj;
    }

    /**
     * Any additional remarks or notes associated with the payout.
     */
    public function withRemarks(?string $remarks): self
    {
        $obj = clone $this;
        $obj['remarks'] = $remarks;

        return $obj;
    }
}
