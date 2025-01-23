<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

class DisputeResponse
{
    /**
     * The amount involved in the dispute, represented as a string to accommodate precision.
     */
    #[SerializedName('amount')]
    public string $amount;

    /**
     * The unique identifier of the business involved in the dispute.
     */
    #[SerializedName('business_id')]
    public string $businessId;

    /**
     * The timestamp of when the dispute was created, in UTC.
     */
    #[SerializedName('created_at')]
    public string $createdAt;

    /**
     * The currency of the disputed amount, represented as an ISO 4217 currency code.
     */
    #[SerializedName('currency')]
    public string $currency;

    /**
     * The unique identifier of the dispute.
     */
    #[SerializedName('dispute_id')]
    public string $disputeId;

    #[SerializedName('dispute_stage')]
    public DisputeStage $disputeStage;

    #[SerializedName('dispute_status')]
    public DisputeStatus $disputeStatus;

    /**
     * The unique identifier of the payment associated with the dispute.
     */
    #[SerializedName('payment_id')]
    public string $paymentId;

    public function __construct(
        string $amount,
        string $businessId,
        string $createdAt,
        string $currency,
        string $disputeId,
        DisputeStage $disputeStage,
        DisputeStatus $disputeStatus,
        string $paymentId
    ) {
        $this->amount = $amount;
        $this->businessId = $businessId;
        $this->createdAt = $createdAt;
        $this->currency = $currency;
        $this->disputeId = $disputeId;
        $this->disputeStage = $disputeStage;
        $this->disputeStatus = $disputeStatus;
        $this->paymentId = $paymentId;
    }
}
