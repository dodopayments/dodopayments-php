<?php

declare(strict_types=1);

namespace DodoPayments\Refunds;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Refunds\RefundListParams\Status;

/**
 * @phpstan-type list_params = array{
 *   createdAtGte?: \DateTimeInterface,
 *   createdAtLte?: \DateTimeInterface,
 *   customerID?: string,
 *   pageNumber?: int,
 *   pageSize?: int,
 *   status?: Status::*,
 * }
 */
final class RefundListParams implements BaseModel
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
     * Page number default is 0.
     */
    #[Api(optional: true)]
    public ?int $pageNumber;

    /**
     * Page size default is 10 max is 100.
     */
    #[Api(optional: true)]
    public ?int $pageSize;

    /**
     * Filter by status.
     *
     * @var null|Status::* $status
     */
    #[Api(enum: Status::class, optional: true)]
    public ?string $status;

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
     * @param null|Status::* $status
     */
    public static function from(
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $customerID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?string $status = null,
    ): self {
        $obj = new self;

        null !== $createdAtGte && $obj->createdAtGte = $createdAtGte;
        null !== $createdAtLte && $obj->createdAtLte = $createdAtLte;
        null !== $customerID && $obj->customerID = $customerID;
        null !== $pageNumber && $obj->pageNumber = $pageNumber;
        null !== $pageSize && $obj->pageSize = $pageSize;
        null !== $status && $obj->status = $status;

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

    /**
     * Filter by status.
     *
     * @param Status::* $status
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
