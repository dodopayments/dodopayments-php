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
 * @phpstan-type RefundListParamsShape = array{
 *   created_at_gte?: \DateTimeInterface,
 *   created_at_lte?: \DateTimeInterface,
 *   customer_id?: string,
 *   page_number?: int,
 *   page_size?: int,
 *   status?: Status|value-of<Status>,
 * }
 */
final class RefundListParams implements BaseModel
{
    /** @use SdkModel<RefundListParamsShape> */
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
     * Page number default is 0.
     */
    #[Api(optional: true)]
    public ?int $page_number;

    /**
     * Page size default is 10 max is 100.
     */
    #[Api(optional: true)]
    public ?int $page_size;

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
        ?\DateTimeInterface $created_at_gte = null,
        ?\DateTimeInterface $created_at_lte = null,
        ?string $customer_id = null,
        ?int $page_number = null,
        ?int $page_size = null,
        Status|string|null $status = null,
    ): self {
        $obj = new self;

        null !== $created_at_gte && $obj->created_at_gte = $created_at_gte;
        null !== $created_at_lte && $obj->created_at_lte = $created_at_lte;
        null !== $customer_id && $obj->customer_id = $customer_id;
        null !== $page_number && $obj->page_number = $page_number;
        null !== $page_size && $obj->page_size = $page_size;
        null !== $status && $obj['status'] = $status;

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
