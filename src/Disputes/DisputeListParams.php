<?php

declare(strict_types=1);

namespace Dodopayments\Disputes;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Disputes\DisputeListParams\DisputeStage;
use Dodopayments\Disputes\DisputeListParams\DisputeStatus;

/**
 * @see Dodopayments\Services\DisputesService::list()
 *
 * @phpstan-type DisputeListParamsShape = array{
 *   createdAtGte?: \DateTimeInterface,
 *   createdAtLte?: \DateTimeInterface,
 *   customerID?: string,
 *   disputeStage?: \Dodopayments\Disputes\DisputeListParams\DisputeStage|value-of<\Dodopayments\Disputes\DisputeListParams\DisputeStage>,
 *   disputeStatus?: \Dodopayments\Disputes\DisputeListParams\DisputeStatus|value-of<\Dodopayments\Disputes\DisputeListParams\DisputeStatus>,
 *   pageNumber?: int,
 *   pageSize?: int,
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
    #[Optional]
    public ?\DateTimeInterface $createdAtGte;

    /**
     * Get events created before this time.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAtLte;

    /**
     * Filter by customer_id.
     */
    #[Optional]
    public ?string $customerID;

    /**
     * Filter by dispute stage.
     *
     * @var value-of<DisputeStage>|null $disputeStage
     */
    #[Optional(
        enum: DisputeStage::class
    )]
    public ?string $disputeStage;

    /**
     * Filter by dispute status.
     *
     * @var value-of<DisputeStatus>|null $disputeStatus
     */
    #[Optional(
        enum: DisputeStatus::class
    )]
    public ?string $disputeStatus;

    /**
     * Page number default is 0.
     */
    #[Optional]
    public ?int $pageNumber;

    /**
     * Page size default is 10 max is 100.
     */
    #[Optional]
    public ?int $pageSize;

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
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $customerID = null,
        DisputeStage|string|null $disputeStage = null,
        DisputeStatus|string|null $disputeStatus = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
    ): self {
        $self = new self;

        null !== $createdAtGte && $self['createdAtGte'] = $createdAtGte;
        null !== $createdAtLte && $self['createdAtLte'] = $createdAtLte;
        null !== $customerID && $self['customerID'] = $customerID;
        null !== $disputeStage && $self['disputeStage'] = $disputeStage;
        null !== $disputeStatus && $self['disputeStatus'] = $disputeStatus;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Get events after this created time.
     */
    public function withCreatedAtGte(\DateTimeInterface $createdAtGte): self
    {
        $self = clone $this;
        $self['createdAtGte'] = $createdAtGte;

        return $self;
    }

    /**
     * Get events created before this time.
     */
    public function withCreatedAtLte(\DateTimeInterface $createdAtLte): self
    {
        $self = clone $this;
        $self['createdAtLte'] = $createdAtLte;

        return $self;
    }

    /**
     * Filter by customer_id.
     */
    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * Filter by dispute stage.
     *
     * @param DisputeStage|value-of<DisputeStage> $disputeStage
     */
    public function withDisputeStage(
        DisputeStage|string $disputeStage
    ): self {
        $self = clone $this;
        $self['disputeStage'] = $disputeStage;

        return $self;
    }

    /**
     * Filter by dispute status.
     *
     * @param DisputeStatus|value-of<DisputeStatus> $disputeStatus
     */
    public function withDisputeStatus(
        DisputeStatus|string $disputeStatus
    ): self {
        $self = clone $this;
        $self['disputeStatus'] = $disputeStatus;

        return $self;
    }

    /**
     * Page number default is 0.
     */
    public function withPageNumber(int $pageNumber): self
    {
        $self = clone $this;
        $self['pageNumber'] = $pageNumber;

        return $self;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }
}
