<?php

declare(strict_types=1);

namespace Dodopayments\Disputes;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type DisputeListResponseShape = array{
 *   amount: string,
 *   business_id: string,
 *   created_at: \DateTimeInterface,
 *   currency: string,
 *   dispute_id: string,
 *   dispute_stage: value-of<DisputeStage>,
 *   dispute_status: value-of<DisputeStatus>,
 *   payment_id: string,
 * }
 */
final class DisputeListResponse implements BaseModel
{
    /** @use SdkModel<DisputeListResponseShape> */
    use SdkModel;

    /**
     * The amount involved in the dispute, represented as a string to accommodate precision.
     */
    #[Api]
    public string $amount;

    /**
     * The unique identifier of the business involved in the dispute.
     */
    #[Api]
    public string $business_id;

    /**
     * The timestamp of when the dispute was created, in UTC.
     */
    #[Api]
    public \DateTimeInterface $created_at;

    /**
     * The currency of the disputed amount, represented as an ISO 4217 currency code.
     */
    #[Api]
    public string $currency;

    /**
     * The unique identifier of the dispute.
     */
    #[Api]
    public string $dispute_id;

    /**
     * The current stage of the dispute process.
     *
     * @var value-of<DisputeStage> $dispute_stage
     */
    #[Api(enum: DisputeStage::class)]
    public string $dispute_stage;

    /**
     * The current status of the dispute.
     *
     * @var value-of<DisputeStatus> $dispute_status
     */
    #[Api(enum: DisputeStatus::class)]
    public string $dispute_status;

    /**
     * The unique identifier of the payment associated with the dispute.
     */
    #[Api]
    public string $payment_id;

    /**
     * `new DisputeListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DisputeListResponse::with(
     *   amount: ...,
     *   business_id: ...,
     *   created_at: ...,
     *   currency: ...,
     *   dispute_id: ...,
     *   dispute_stage: ...,
     *   dispute_status: ...,
     *   payment_id: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DisputeListResponse)
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
     * @param DisputeStage|value-of<DisputeStage> $dispute_stage
     * @param DisputeStatus|value-of<DisputeStatus> $dispute_status
     */
    public static function with(
        string $amount,
        string $business_id,
        \DateTimeInterface $created_at,
        string $currency,
        string $dispute_id,
        DisputeStage|string $dispute_stage,
        DisputeStatus|string $dispute_status,
        string $payment_id,
    ): self {
        $obj = new self;

        $obj['amount'] = $amount;
        $obj['business_id'] = $business_id;
        $obj['created_at'] = $created_at;
        $obj['currency'] = $currency;
        $obj['dispute_id'] = $dispute_id;
        $obj['dispute_stage'] = $dispute_stage;
        $obj['dispute_status'] = $dispute_status;
        $obj['payment_id'] = $payment_id;

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
        $obj['business_id'] = $businessID;

        return $obj;
    }

    /**
     * The timestamp of when the dispute was created, in UTC.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

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
     * The unique identifier of the dispute.
     */
    public function withDisputeID(string $disputeID): self
    {
        $obj = clone $this;
        $obj['dispute_id'] = $disputeID;

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
        $obj['dispute_stage'] = $disputeStage;

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
        $obj['dispute_status'] = $disputeStatus;

        return $obj;
    }

    /**
     * The unique identifier of the payment associated with the dispute.
     */
    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj['payment_id'] = $paymentID;

        return $obj;
    }
}
