<?php

declare(strict_types=1);

namespace Dodopayments\Refunds;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Refunds\RefundListParams\Status;

/**
 * @see Dodopayments\Refunds->list
 *
 * @phpstan-type refund_list_params = array{
 *   createdAtGte?: \DateTimeInterface,
 *   createdAtLte?: \DateTimeInterface,
 *   customerID?: string,
 *   pageNumber?: int,
 *   pageSize?: int,
 *   status?: Status|value-of<Status>,
 * }
 */
final class RefundListParams implements BaseModel
{
    /** @use SdkModel<refund_list_params> */
    use SdkModel;
    use SdkParams;

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
     * @var value-of<Status>|null $status
     */
    #[Api(enum: Status::class, optional: true)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status> $status
     */
    public static function with(
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $customerID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        Status|string|null $status = null,
    ): self {
        $obj = new self;

        null !== $createdAtGte && $obj->createdAtGte = $createdAtGte;
        null !== $createdAtLte && $obj->createdAtLte = $createdAtLte;
        null !== $customerID && $obj->customerID = $customerID;
        null !== $pageNumber && $obj->pageNumber = $pageNumber;
        null !== $pageSize && $obj->pageSize = $pageSize;
        null !== $status && $obj['status'] = $status;

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

    /**
     * Filter by status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }
}
