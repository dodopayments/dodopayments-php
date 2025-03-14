<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

class PayoutsResponse
{
    /**
     * The total amount of the payout.
     */
    #[SerializedName('amount')]
    public int $amount;

    /**
     * The unique identifier of the business associated with the payout.
     */
    #[SerializedName('business_id')]
    public string $businessId;

    /**
     * The total value of chargebacks associated with the payout.
     */
    #[SerializedName('chargebacks')]
    public int $chargebacks;

    /**
     * The timestamp when the payout was created, in UTC.
     */
    #[SerializedName('created_at')]
    public string $createdAt;

    #[SerializedName('currency')]
    public Currency $currency;

    /**
     * The fee charged for processing the payout.
     */
    #[SerializedName('fee')]
    public int $fee;

    /**
     * The name of the payout recipient or purpose.
     */
    #[SerializedName('name')]
    public ?string $name;

    /**
     * The payment method used for the payout (e.g., bank transfer, card, etc.).
     */
    #[SerializedName('payment_method')]
    public string $paymentMethod;

    /**
     * The URL of the document associated with the payout.
     */
    #[SerializedName('payout_document_url')]
    public ?string $payoutDocumentUrl;

    /**
     * The unique identifier of the payout.
     */
    #[SerializedName('payout_id')]
    public string $payoutId;

    /**
     * The total value of refunds associated with the payout.
     */
    #[SerializedName('refunds')]
    public int $refunds;

    /**
     * Any additional remarks or notes associated with the payout.
     */
    #[SerializedName('remarks')]
    public ?string $remarks;

    #[SerializedName('status')]
    public PayoutStatus $status;

    /**
     * The tax applied to the payout.
     */
    #[SerializedName('tax')]
    public int $tax;

    /**
     * The timestamp when the payout was last updated, in UTC.
     */
    #[SerializedName('updated_at')]
    public string $updatedAt;

    public function __construct(
        int $amount,
        string $businessId,
        int $chargebacks,
        string $createdAt,
        Currency $currency,
        int $fee,
        ?string $name = null,
        string $paymentMethod,
        ?string $payoutDocumentUrl = null,
        string $payoutId,
        int $refunds,
        ?string $remarks = null,
        PayoutStatus $status,
        int $tax,
        string $updatedAt
    ) {
        $this->amount = $amount;
        $this->businessId = $businessId;
        $this->chargebacks = $chargebacks;
        $this->createdAt = $createdAt;
        $this->currency = $currency;
        $this->fee = $fee;
        $this->name = $name;
        $this->paymentMethod = $paymentMethod;
        $this->payoutDocumentUrl = $payoutDocumentUrl;
        $this->payoutId = $payoutId;
        $this->refunds = $refunds;
        $this->remarks = $remarks;
        $this->status = $status;
        $this->tax = $tax;
        $this->updatedAt = $updatedAt;
    }
}
