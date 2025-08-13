<?php

declare(strict_types=1);

namespace DodoPayments\Disputes;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Disputes\DisputeListParams\DisputeStage as DisputeStage1;
use DodoPayments\Disputes\DisputeListParams\DisputeStatus as DisputeStatus1;

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
    public static function from(
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
    public function setCreatedAtGte(\DateTimeInterface $createdAtGte): self
    {
        $this->createdAtGte = $createdAtGte;

        return $this;
    }

    /**
     * Get events created before this time.
     */
    public function setCreatedAtLte(\DateTimeInterface $createdAtLte): self
    {
        $this->createdAtLte = $createdAtLte;

        return $this;
    }

    /**
     * Filter by customer_id.
     */
    public function setCustomerID(string $customerID): self
    {
        $this->customerID = $customerID;

        return $this;
    }

    /**
     * Filter by dispute stage.
     *
     * @param DisputeStage1::* $disputeStage
     */
    public function setDisputeStage(string $disputeStage): self
    {
        $this->disputeStage = $disputeStage;

        return $this;
    }

    /**
     * Filter by dispute status.
     *
     * @param DisputeStatus1::* $disputeStatus
     */
    public function setDisputeStatus(string $disputeStatus): self
    {
        $this->disputeStatus = $disputeStatus;

        return $this;
    }

    /**
     * Page number default is 0.
     */
    public function setPageNumber(int $pageNumber): self
    {
        $this->pageNumber = $pageNumber;

        return $this;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function setPageSize(int $pageSize): self
    {
        $this->pageSize = $pageSize;

        return $this;
    }
}
