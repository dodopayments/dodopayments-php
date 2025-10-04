<?php

declare(strict_types=1);

namespace Dodopayments\Disputes;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type dispute_alias = array{
 *   amount: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: string,
 *   disputeID: string,
 *   disputeStage: value-of<DisputeStage>,
 *   disputeStatus: value-of<DisputeStatus>,
 *   paymentID: string,
 *   remarks?: string|null,
 * }
 */
final class Dispute implements BaseModel
{
    /** @use SdkModel<dispute_alias> */
    use SdkModel;

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
     * The unique identifier of the dispute.
     */
    #[Api('dispute_id')]
    public string $disputeID;

    /**
     * The current stage of the dispute process.
     *
     * @var value-of<DisputeStage> $disputeStage
     */
    #[Api('dispute_stage', enum: DisputeStage::class)]
    public string $disputeStage;

    /**
     * The current status of the dispute.
     *
     * @var value-of<DisputeStatus> $disputeStatus
     */
    #[Api('dispute_status', enum: DisputeStatus::class)]
    public string $disputeStatus;

    /**
     * The unique identifier of the payment associated with the dispute.
     */
    #[Api('payment_id')]
    public string $paymentID;

    /**
     * Remarks.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $remarks;

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
     * (new Dispute)
     *   ->withAmount(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
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
     * @param DisputeStage|value-of<DisputeStage> $disputeStage
     * @param DisputeStatus|value-of<DisputeStatus> $disputeStatus
     */
    public static function with(
        string $amount,
        string $businessID,
        \DateTimeInterface $createdAt,
        string $currency,
        string $disputeID,
        DisputeStage|string $disputeStage,
        DisputeStatus|string $disputeStatus,
        string $paymentID,
        ?string $remarks = null,
    ): self {
        $obj = new self;

        $obj->amount = $amount;
        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->currency = $currency;
        $obj->disputeID = $disputeID;
        $obj['disputeStage'] = $disputeStage;
        $obj['disputeStatus'] = $disputeStatus;
        $obj->paymentID = $paymentID;

        null !== $remarks && $obj->remarks = $remarks;

        return $obj;
    }

    /**
     * The amount involved in the dispute, represented as a string to accommodate precision.
     */
    public function withAmount(string $amount): self
    {
        $obj = clone $this;
        $obj->amount = $amount;

        return $obj;
    }

    /**
     * The unique identifier of the business involved in the dispute.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    /**
     * The timestamp of when the dispute was created, in UTC.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * The currency of the disputed amount, represented as an ISO 4217 currency code.
     */
    public function withCurrency(string $currency): self
    {
        $obj = clone $this;
        $obj->currency = $currency;

        return $obj;
    }

    /**
     * The unique identifier of the dispute.
     */
    public function withDisputeID(string $disputeID): self
    {
        $obj = clone $this;
        $obj->disputeID = $disputeID;

        return $obj;
    }

    /**
     * The current stage of the dispute process.
     *
     * @param DisputeStage|value-of<DisputeStage> $disputeStage
     */
    public function withDisputeStage(DisputeStage|string $disputeStage): self
    {
        $obj = clone $this;
        $obj['disputeStage'] = $disputeStage;

        return $obj;
    }

    /**
     * The current status of the dispute.
     *
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
        $obj->paymentID = $paymentID;

        return $obj;
    }

    /**
     * Remarks.
     */
    public function withRemarks(?string $remarks): self
    {
        $obj = clone $this;
        $obj->remarks = $remarks;

        return $obj;
    }
}
