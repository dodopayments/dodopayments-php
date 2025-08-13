<?php

declare(strict_types=1);

namespace DodoPayments\Disputes;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Payments\CustomerLimitedDetails;

/**
 * @phpstan-type get_dispute_alias = array{
 *   amount: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: string,
 *   customer: CustomerLimitedDetails,
 *   disputeID: string,
 *   disputeStage: DisputeStage::*,
 *   disputeStatus: DisputeStatus::*,
 *   paymentID: string,
 *   reason?: string|null,
 *   remarks?: string|null,
 * }
 */
final class GetDispute implements BaseModel
{
    use Model;

    /**
     * The amount involved in the dispute, represented as a string to accommodate precision.
     */
    #[Api]
    public string $amount;

    /**
     * The unique identifier of the business involved in the dispute.
     */
    #[Api('business_id')]
    public string $businessID;

    /**
     * The timestamp of when the dispute was created, in UTC.
     */
    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The currency of the disputed amount, represented as an ISO 4217 currency code.
     */
    #[Api]
    public string $currency;

    /**
     * The customer who filed the dispute.
     */
    #[Api]
    public CustomerLimitedDetails $customer;

    /**
     * The unique identifier of the dispute.
     */
    #[Api('dispute_id')]
    public string $disputeID;

    /**
     * The current stage of the dispute process.
     *
     * @var DisputeStage::* $disputeStage
     */
    #[Api('dispute_stage', enum: DisputeStage::class)]
    public string $disputeStage;

    /**
     * The current status of the dispute.
     *
     * @var DisputeStatus::* $disputeStatus
     */
    #[Api('dispute_status', enum: DisputeStatus::class)]
    public string $disputeStatus;

    /**
     * The unique identifier of the payment associated with the dispute.
     */
    #[Api('payment_id')]
    public string $paymentID;

    /**
     * Reason for the dispute.
     */
    #[Api(optional: true)]
    public ?string $reason;

    /**
     * Remarks.
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
     * @param DisputeStage::* $disputeStage
     * @param DisputeStatus::* $disputeStatus
     */
    public static function from(
        string $amount,
        string $businessID,
        \DateTimeInterface $createdAt,
        string $currency,
        CustomerLimitedDetails $customer,
        string $disputeID,
        string $disputeStage,
        string $disputeStatus,
        string $paymentID,
        ?string $reason = null,
        ?string $remarks = null,
    ): self {
        $obj = new self;

        $obj->amount = $amount;
        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->currency = $currency;
        $obj->customer = $customer;
        $obj->disputeID = $disputeID;
        $obj->disputeStage = $disputeStage;
        $obj->disputeStatus = $disputeStatus;
        $obj->paymentID = $paymentID;

        null !== $reason && $obj->reason = $reason;
        null !== $remarks && $obj->remarks = $remarks;

        return $obj;
    }

    /**
     * The amount involved in the dispute, represented as a string to accommodate precision.
     */
    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * The unique identifier of the business involved in the dispute.
     */
    public function setBusinessID(string $businessID): self
    {
        $this->businessID = $businessID;

        return $this;
    }

    /**
     * The timestamp of when the dispute was created, in UTC.
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * The currency of the disputed amount, represented as an ISO 4217 currency code.
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * The customer who filed the dispute.
     */
    public function setCustomer(CustomerLimitedDetails $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * The unique identifier of the dispute.
     */
    public function setDisputeID(string $disputeID): self
    {
        $this->disputeID = $disputeID;

        return $this;
    }

    /**
     * The current stage of the dispute process.
     *
     * @param DisputeStage::* $disputeStage
     */
    public function setDisputeStage(string $disputeStage): self
    {
        $this->disputeStage = $disputeStage;

        return $this;
    }

    /**
     * The current status of the dispute.
     *
     * @param DisputeStatus::* $disputeStatus
     */
    public function setDisputeStatus(string $disputeStatus): self
    {
        $this->disputeStatus = $disputeStatus;

        return $this;
    }

    /**
     * The unique identifier of the payment associated with the dispute.
     */
    public function setPaymentID(string $paymentID): self
    {
        $this->paymentID = $paymentID;

        return $this;
    }

    /**
     * Reason for the dispute.
     */
    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Remarks.
     */
    public function setRemarks(?string $remarks): self
    {
        $this->remarks = $remarks;

        return $this;
    }
}
