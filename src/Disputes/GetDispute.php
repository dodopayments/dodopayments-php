<?php

declare(strict_types=1);

namespace Dodopayments\Disputes;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Payments\CustomerLimitedDetails;

/**
 * @phpstan-type GetDisputeShape = array{
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
 * }
 */
final class GetDispute implements BaseModel
{
    /** @use SdkModel<GetDisputeShape> */
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

    /**
     * The customer who filed the dispute.
     */
    #[Required]
    public CustomerLimitedDetails $customer;

    /**
     * The unique identifier of the dispute.
     */
    #[Required('dispute_id')]
    public string $disputeID;

    /**
     * The current stage of the dispute process.
     *
     * @var value-of<DisputeStage> $disputeStage
     */
    #[Required('dispute_stage', enum: DisputeStage::class)]
    public string $disputeStage;

    /**
     * The current status of the dispute.
     *
     * @var value-of<DisputeStatus> $disputeStatus
     */
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

    /**
     * `new GetDispute()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GetDispute::with(
     *   amount: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   customer: ...,
     *   disputeID: ...,
     *   disputeStage: ...,
     *   disputeStatus: ...,
     *   paymentID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GetDispute)
     *   ->withAmount(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withCustomer(...)
     *   ->withDisputeID(...)
     *   ->withDisputeStage(...)
     *   ->withDisputeStatus(...)
     *   ->withPaymentID(...)
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
        ?string $reason = null,
        ?string $remarks = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['customer'] = $customer;
        $self['disputeID'] = $disputeID;
        $self['disputeStage'] = $disputeStage;
        $self['disputeStatus'] = $disputeStatus;
        $self['paymentID'] = $paymentID;

        null !== $reason && $self['reason'] = $reason;
        null !== $remarks && $self['remarks'] = $remarks;

        return $self;
    }

    /**
     * The amount involved in the dispute, represented as a string to accommodate precision.
     */
    public function withAmount(string $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The unique identifier of the business involved in the dispute.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * The timestamp of when the dispute was created, in UTC.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The currency of the disputed amount, represented as an ISO 4217 currency code.
     */
    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The customer who filed the dispute.
     *
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
        $self = clone $this;
        $self['customer'] = $customer;

        return $self;
    }

    /**
     * The unique identifier of the dispute.
     */
    public function withDisputeID(string $disputeID): self
    {
        $self = clone $this;
        $self['disputeID'] = $disputeID;

        return $self;
    }

    /**
     * The current stage of the dispute process.
     *
     * @param DisputeStage|value-of<DisputeStage> $disputeStage
     */
    public function withDisputeStage(DisputeStage|string $disputeStage): self
    {
        $self = clone $this;
        $self['disputeStage'] = $disputeStage;

        return $self;
    }

    /**
     * The current status of the dispute.
     *
     * @param DisputeStatus|value-of<DisputeStatus> $disputeStatus
     */
    public function withDisputeStatus(DisputeStatus|string $disputeStatus): self
    {
        $self = clone $this;
        $self['disputeStatus'] = $disputeStatus;

        return $self;
    }

    /**
     * The unique identifier of the payment associated with the dispute.
     */
    public function withPaymentID(string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    /**
     * Reason for the dispute.
     */
    public function withReason(?string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Remarks.
     */
    public function withRemarks(?string $remarks): self
    {
        $self = clone $this;
        $self['remarks'] = $remarks;

        return $self;
    }
}
