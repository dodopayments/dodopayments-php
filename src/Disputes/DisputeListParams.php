<?php

declare(strict_types=1);

namespace Dodopayments\Disputes;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Concerns\Params;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Disputes\DisputeListParams\DisputeStage as DisputeStage1;
use Dodopayments\Disputes\DisputeListParams\DisputeStatus as DisputeStatus1;

/**
 * @phpstan-type list_params = array{
 *   createdAtGte?: \DateTimeInterface,
 *   createdAtLte?: \DateTimeInterface,
 *   customerID?: string,
 *   disputeStage?: DisputeStage1::*,
 *   disputeStatus?: DisputeStatus1::*,
 *   pageNumber?: int,
 *   pageSize?: int,
 * }
 */
final class DisputeListParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Get events after this created time.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $createdAtGte;

    /**
     * Get events created before this time.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $createdAtLte;

    /**
     * Filter by customer_id.
     */
    #[Api(optional: true)]
    public ?string $customerID;

    /**
     * Filter by dispute stage.
     *
     * @var null|DisputeStage1::* $disputeStage
     */
    #[Api(enum: DisputeStage1::class, optional: true)]
    public ?string $disputeStage;

    /**
     * Filter by dispute status.
     *
     * @var null|DisputeStatus1::* $disputeStatus
     */
    #[Api(enum: DisputeStatus1::class, optional: true)]
    public ?string $disputeStatus;

    /**
     * Page number default is 0.
     */
    #[Api(optional: true)]
    public ?int $pageNumber;

    /**
     * Page size default is 10 max is 100.
     */
    #[Api(optional: true)]
    public ?int $pageSize;

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
     * @param null|DisputeStage1::* $disputeStage
     * @param null|DisputeStatus1::* $disputeStatus
     */
    public static function with(
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $customerID = null,
        ?string $disputeStage = null,
        ?string $disputeStatus = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
    ): self {
        $obj = new self;

        null !== $createdAtGte && $obj->createdAtGte = $createdAtGte;
        null !== $createdAtLte && $obj->createdAtLte = $createdAtLte;
        null !== $customerID && $obj->customerID = $customerID;
        null !== $disputeStage && $obj->disputeStage = $disputeStage;
        null !== $disputeStatus && $obj->disputeStatus = $disputeStatus;
        null !== $pageNumber && $obj->pageNumber = $pageNumber;
        null !== $pageSize && $obj->pageSize = $pageSize;

        return $obj;
    }

    /**
     * Get events after this created time.
     */
    public function withCreatedAtGte(\DateTimeInterface $createdAtGte): self
    {
        $obj = clone $this;
        $obj->createdAtGte = $createdAtGte;

        return $obj;
    }

    /**
     * Get events created before this time.
     */
    public function withCreatedAtLte(\DateTimeInterface $createdAtLte): self
    {
        $obj = clone $this;
        $obj->createdAtLte = $createdAtLte;

        return $obj;
    }

    /**
     * Filter by customer_id.
     */
    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj->customerID = $customerID;

        return $obj;
    }

    /**
     * Filter by dispute stage.
     *
     * @param DisputeStage1::* $disputeStage
     */
    public function withDisputeStage(string $disputeStage): self
    {
        $obj = clone $this;
        $obj->disputeStage = $disputeStage;

        return $obj;
    }

    /**
     * Filter by dispute status.
     *
     * @param DisputeStatus1::* $disputeStatus
     */
    public function withDisputeStatus(string $disputeStatus): self
    {
        $obj = clone $this;
        $obj->disputeStatus = $disputeStatus;

        return $obj;
    }

    /**
     * Page number default is 0.
     */
    public function withPageNumber(int $pageNumber): self
    {
        $obj = clone $this;
        $obj->pageNumber = $pageNumber;

        return $obj;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj->pageSize = $pageSize;

        return $obj;
    }
}
