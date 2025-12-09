<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Disputes\DisputeStage;
use Dodopayments\Disputes\DisputeStatus;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Dispute\PayloadType;

/**
 * @phpstan-type DisputeShape = array{
 *   amount: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: string,
 *   customer: CustomerLimitedDetails,
 *   disputeID: string,
 *   disputeStage: value-of<DisputeStage>,
 *   disputeStatus: value-of<DisputeStatus>,
 *   paymentID: string,
 *   reason?: string|null,
 *   remarks?: string|null,
 *   payloadType: value-of<PayloadType>,
 * }
 */
final class Dispute implements BaseModel
{
    /** @use SdkModel<DisputeShape> */
    use SdkModel;

    /**
     * The amount involved in the dispute, represented as a string to accommodate precision.
     */
    #[Required]
    public string $amount;

    /**
     * The unique identifier of the business involved in the dispute.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * The timestamp of when the dispute was created, in UTC.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The currency of the disputed amount, represented as an ISO 4217 currency code.
     */
    #[Required]
    public string $currency;

    #[Required]
    public CustomerLimitedDetails $customer;

    /**
     * The unique identifier of the dispute.
     */
    #[Required('dispute_id')]
    public string $disputeID;

    /** @var value-of<DisputeStage> $disputeStage */
    #[Required('dispute_stage', enum: DisputeStage::class)]
    public string $disputeStage;

    /** @var value-of<DisputeStatus> $disputeStatus */
    #[Required('dispute_status', enum: DisputeStatus::class)]
    public string $disputeStatus;

    /**
     * The unique identifier of the payment associated with the dispute.
     */
    #[Required('payment_id')]
    public string $paymentID;

    /**
     * Reason for the dispute.
     */
    #[Optional(nullable: true)]
    public ?string $reason;

    /**
     * Remarks.
     */
    #[Optional(nullable: true)]
    public ?string $remarks;

    /** @var value-of<PayloadType> $payloadType */
    #[Required('payload_type', enum: PayloadType::class)]
    public string $payloadType;

    /**
     * `new Dispute()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Dispute::with(
     *   amount: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   customer: ...,
     *   disputeID: ...,
     *   disputeStage: ...,
     *   disputeStatus: ...,
     *   paymentID: ...,
     *   payloadType: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Dispute)
     *   ->withAmount(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withCustomer(...)
     *   ->withDisputeID(...)
     *   ->withDisputeStage(...)
     *   ->withDisputeStatus(...)
     *   ->withPaymentID(...)
     *   ->withPayloadType(...)
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
     * @param CustomerLimitedDetails|array{
     *   customerID: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phoneNumber?: string|null,
     * } $customer
     * @param DisputeStage|value-of<DisputeStage> $disputeStage
     * @param DisputeStatus|value-of<DisputeStatus> $disputeStatus
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public static function with(
        string $amount,
        string $businessID,
        \DateTimeInterface $createdAt,
        string $currency,
        CustomerLimitedDetails|array $customer,
        string $disputeID,
        DisputeStage|string $disputeStage,
        DisputeStatus|string $disputeStatus,
        string $paymentID,
        PayloadType|string $payloadType,
        ?string $reason = null,
        ?string $remarks = null,
    ): self {
        $obj = new self;

        $obj['amount'] = $amount;
        $obj['businessID'] = $businessID;
        $obj['createdAt'] = $createdAt;
        $obj['currency'] = $currency;
        $obj['customer'] = $customer;
        $obj['disputeID'] = $disputeID;
        $obj['disputeStage'] = $disputeStage;
        $obj['disputeStatus'] = $disputeStatus;
        $obj['paymentID'] = $paymentID;
        $obj['payloadType'] = $payloadType;

        null !== $reason && $obj['reason'] = $reason;
        null !== $remarks && $obj['remarks'] = $remarks;

        return $obj;
    }

    /**
     * The amount involved in the dispute, represented as a string to accommodate precision.
     */
    public function withAmount(string $amount): self
    {
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }

    /**
     * The unique identifier of the business involved in the dispute.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['businessID'] = $businessID;

        return $obj;
    }

    /**
     * The timestamp of when the dispute was created, in UTC.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    /**
     * The currency of the disputed amount, represented as an ISO 4217 currency code.
     */
    public function withCurrency(string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    /**
     * @param CustomerLimitedDetails|array{
     *   customerID: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phoneNumber?: string|null,
     * } $customer
     */
    public function withCustomer(CustomerLimitedDetails|array $customer): self
    {
        $obj = clone $this;
        $obj['customer'] = $customer;

        return $obj;
    }

    /**
     * The unique identifier of the dispute.
     */
    public function withDisputeID(string $disputeID): self
    {
        $obj = clone $this;
        $obj['disputeID'] = $disputeID;

        return $obj;
    }

    /**
     * @param DisputeStage|value-of<DisputeStage> $disputeStage
     */
    public function withDisputeStage(DisputeStage|string $disputeStage): self
    {
        $obj = clone $this;
        $obj['disputeStage'] = $disputeStage;

        return $obj;
    }

    /**
     * @param DisputeStatus|value-of<DisputeStatus> $disputeStatus
     */
    public function withDisputeStatus(DisputeStatus|string $disputeStatus): self
    {
        $obj = clone $this;
        $obj['disputeStatus'] = $disputeStatus;

        return $obj;
    }

    /**
     * The unique identifier of the payment associated with the dispute.
     */
    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj['paymentID'] = $paymentID;

        return $obj;
    }

    /**
     * Reason for the dispute.
     */
    public function withReason(?string $reason): self
    {
        $obj = clone $this;
        $obj['reason'] = $reason;

        return $obj;
    }

    /**
     * Remarks.
     */
    public function withRemarks(?string $remarks): self
    {
        $obj = clone $this;
        $obj['remarks'] = $remarks;

        return $obj;
    }

    /**
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public function withPayloadType(PayloadType|string $payloadType): self
    {
        $obj = clone $this;
        $obj['payloadType'] = $payloadType;

        return $obj;
    }
}
