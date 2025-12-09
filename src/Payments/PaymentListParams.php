<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Payments\PaymentListParams\Status;

/**
 * @see Dodopayments\Services\PaymentsService::list()
 *
 * @phpstan-type PaymentListParamsShape = array{
 *   brand_id?: string,
 *   created_at_gte?: \DateTimeInterface,
 *   created_at_lte?: \DateTimeInterface,
 *   customer_id?: string,
 *   page_number?: int,
 *   page_size?: int,
 *   status?: Status|value-of<Status>,
 *   subscription_id?: string,
 * }
 */
final class PaymentListParams implements BaseModel
{
    /** @use SdkModel<PaymentListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * filter by Brand id.
     */
    #[Optional]
    public ?string $brand_id;

    /**
     * Get events after this created time.
     */
    #[Optional]
    public ?\DateTimeInterface $created_at_gte;

    /**
     * Get events created before this time.
     */
    #[Optional]
    public ?\DateTimeInterface $created_at_lte;

    /**
     * Filter by customer id.
     */
    #[Optional]
    public ?string $customer_id;

    /**
     * Page number default is 0.
     */
    #[Optional]
    public ?int $page_number;

    /**
     * Page size default is 10 max is 100.
     */
    #[Optional]
    public ?int $page_size;

    /**
     * Filter by status.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Filter by subscription id.
     */
    #[Optional]
    public ?string $subscription_id;

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
        ?string $brand_id = null,
        ?\DateTimeInterface $created_at_gte = null,
        ?\DateTimeInterface $created_at_lte = null,
        ?string $customer_id = null,
        ?int $page_number = null,
        ?int $page_size = null,
        Status|string|null $status = null,
        ?string $subscription_id = null,
    ): self {
        $obj = new self;

        null !== $brand_id && $obj['brand_id'] = $brand_id;
        null !== $created_at_gte && $obj['created_at_gte'] = $created_at_gte;
        null !== $created_at_lte && $obj['created_at_lte'] = $created_at_lte;
        null !== $customer_id && $obj['customer_id'] = $customer_id;
        null !== $page_number && $obj['page_number'] = $page_number;
        null !== $page_size && $obj['page_size'] = $page_size;
        null !== $status && $obj['status'] = $status;
        null !== $subscription_id && $obj['subscription_id'] = $subscription_id;

        return $obj;
    }

    /**
     * filter by Brand id.
     */
    public function withBrandID(string $brandID): self
    {
        $obj = clone $this;
        $obj['brand_id'] = $brandID;

        return $obj;
    }

    /**
     * Get events after this created time.
     */
    public function withCreatedAtGte(\DateTimeInterface $createdAtGte): self
    {
        $obj = clone $this;
        $obj['created_at_gte'] = $createdAtGte;

        return $obj;
    }

    /**
     * Get events created before this time.
     */
    public function withCreatedAtLte(\DateTimeInterface $createdAtLte): self
    {
        $obj = clone $this;
        $obj['created_at_lte'] = $createdAtLte;

        return $obj;
    }

    /**
     * Filter by customer id.
     */
    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj['customer_id'] = $customerID;

        return $obj;
    }

    /**
     * Page number default is 0.
     */
    public function withPageNumber(int $pageNumber): self
    {
        $obj = clone $this;
        $obj['page_number'] = $pageNumber;

        return $obj;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj['page_size'] = $pageSize;

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

    /**
     * Filter by subscription id.
     */
    public function withSubscriptionID(string $subscriptionID): self
    {
        $obj = clone $this;
        $obj['subscription_id'] = $subscriptionID;

        return $obj;
    }
}
