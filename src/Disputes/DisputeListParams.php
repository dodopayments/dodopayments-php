<?php

declare(strict_types=1);

namespace Dodopayments\Disputes;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Disputes\DisputeListParams\DisputeStage;
use Dodopayments\Disputes\DisputeListParams\DisputeStatus;

/**
 * @see Dodopayments\Services\DisputesService::list()
 *
 * @phpstan-type DisputeListParamsShape = array{
 *   created_at_gte?: \DateTimeInterface,
 *   created_at_lte?: \DateTimeInterface,
 *   customer_id?: string,
 *   dispute_stage?: \Dodopayments\Disputes\DisputeListParams\DisputeStage|value-of<\Dodopayments\Disputes\DisputeListParams\DisputeStage>,
 *   dispute_status?: \Dodopayments\Disputes\DisputeListParams\DisputeStatus|value-of<\Dodopayments\Disputes\DisputeListParams\DisputeStatus>,
 *   page_number?: int,
 *   page_size?: int,
 * }
 */
final class DisputeListParams implements BaseModel
{
    /** @use SdkModel<DisputeListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Get events after this created time.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $created_at_gte;

    /**
     * Get events created before this time.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $created_at_lte;

    /**
     * Filter by customer_id.
     */
    #[Api(optional: true)]
    public ?string $customer_id;

    /**
     * Filter by dispute stage.
     *
     * @var value-of<DisputeStage>|null $dispute_stage
     */
    #[Api(
        enum: DisputeStage::class,
        optional: true,
    )]
    public ?string $dispute_stage;

    /**
     * Filter by dispute status.
     *
     * @var value-of<DisputeStatus>|null $dispute_status
     */
    #[Api(
        enum: DisputeStatus::class,
        optional: true,
    )]
    public ?string $dispute_status;

    /**
     * Page number default is 0.
     */
    #[Api(optional: true)]
    public ?int $page_number;

    /**
     * Page size default is 10 max is 100.
     */
    #[Api(optional: true)]
    public ?int $page_size;

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
        ?\DateTimeInterface $created_at_gte = null,
        ?\DateTimeInterface $created_at_lte = null,
        ?string $customer_id = null,
        DisputeStage|string|null $dispute_stage = null,
        DisputeStatus|string|null $dispute_status = null,
        ?int $page_number = null,
        ?int $page_size = null,
    ): self {
        $obj = new self;

        null !== $created_at_gte && $obj->created_at_gte = $created_at_gte;
        null !== $created_at_lte && $obj->created_at_lte = $created_at_lte;
        null !== $customer_id && $obj->customer_id = $customer_id;
        null !== $dispute_stage && $obj['dispute_stage'] = $dispute_stage;
        null !== $dispute_status && $obj['dispute_status'] = $dispute_status;
        null !== $page_number && $obj->page_number = $page_number;
        null !== $page_size && $obj->page_size = $page_size;

        return $obj;
    }

    /**
     * Get events after this created time.
     */
    public function withCreatedAtGte(\DateTimeInterface $createdAtGte): self
    {
        $obj = clone $this;
        $obj->created_at_gte = $createdAtGte;

        return $obj;
    }

    /**
     * Get events created before this time.
     */
    public function withCreatedAtLte(\DateTimeInterface $createdAtLte): self
    {
        $obj = clone $this;
        $obj->created_at_lte = $createdAtLte;

        return $obj;
    }

    /**
     * Filter by customer_id.
     */
    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj->customer_id = $customerID;

        return $obj;
    }

    /**
     * Filter by dispute stage.
     *
     * @param DisputeStage|value-of<DisputeStage> $disputeStage
     */
    public function withDisputeStage(
        DisputeStage|string $disputeStage
    ): self {
        $obj = clone $this;
        $obj['dispute_stage'] = $disputeStage;

        return $obj;
    }

    /**
     * Filter by dispute status.
     *
     * @param DisputeStatus|value-of<DisputeStatus> $disputeStatus
     */
    public function withDisputeStatus(
        DisputeStatus|string $disputeStatus
    ): self {
        $obj = clone $this;
        $obj['dispute_status'] = $disputeStatus;

        return $obj;
    }

    /**
     * Page number default is 0.
     */
    public function withPageNumber(int $pageNumber): self
    {
        $obj = clone $this;
        $obj->page_number = $pageNumber;

        return $obj;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj->page_size = $pageSize;

        return $obj;
    }
}
