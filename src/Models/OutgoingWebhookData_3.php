<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

class OutgoingWebhookData3
{
    /**
     * The refunded amount.
     */
    #[SerializedName('amount')]
    public ?int $amount;

    /**
     * The unique identifier of the business issuing the refund.
     */
    #[SerializedName('business_id')]
    public string $businessId;

    /**
     * The timestamp of when the refund was created in UTC.
     */
    #[SerializedName('created_at')]
    public string $createdAt;

    #[SerializedName('currency')]
    public ?Currency $currency;

    /**
     * The unique identifier of the payment associated with the refund.
     */
    #[SerializedName('payment_id')]
    public string $paymentId;

    /**
     * The reason provided for the refund, if any. Optional.
     */
    #[SerializedName('reason')]
    public ?string $reason;

    /**
     * The unique identifier of the refund.
     */
    #[SerializedName('refund_id')]
    public string $refundId;

    #[SerializedName('status')]
    public RefundStatus $status;

    #[SerializedName('payload_type')]
    public OutgoingWebhookData3PayloadType $payloadType;

    public function __construct(
        ?int $amount = null,
        string $businessId,
        string $createdAt,
        ?Currency $currency = null,
        string $paymentId,
        ?string $reason = null,
        string $refundId,
        RefundStatus $status,
        OutgoingWebhookData3PayloadType $payloadType
    ) {
        $this->amount = $amount;
        $this->businessId = $businessId;
        $this->createdAt = $createdAt;
        $this->currency = $currency;
        $this->paymentId = $paymentId;
        $this->reason = $reason;
        $this->refundId = $refundId;
        $this->status = $status;
        $this->payloadType = $payloadType;
    }
}
