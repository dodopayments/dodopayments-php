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
 *   brandID?: string|null,
 *   createdAtGte?: \DateTimeInterface|null,
 *   createdAtLte?: \DateTimeInterface|null,
 *   customerID?: string|null,
 *   pageNumber?: int|null,
 *   pageSize?: int|null,
 *   productID?: string|null,
 *   status?: null|Status|value-of<Status>,
 *   subscriptionID?: string|null,
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
    public ?string $brandID;

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
     * Filter by customer id.
     */
    #[Optional]
    public ?string $customerID;

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

    /**
     * Filter by product id.
     */
    #[Optional]
    public ?string $productID;

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
    public ?string $subscriptionID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $brandID = null,
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $customerID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?string $productID = null,
        Status|string|null $status = null,
        ?string $subscriptionID = null,
    ): self {
        $self = new self;

        null !== $brandID && $self['brandID'] = $brandID;
        null !== $createdAtGte && $self['createdAtGte'] = $createdAtGte;
        null !== $createdAtLte && $self['createdAtLte'] = $createdAtLte;
        null !== $customerID && $self['customerID'] = $customerID;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;
        null !== $productID && $self['productID'] = $productID;
        null !== $status && $self['status'] = $status;
        null !== $subscriptionID && $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    /**
     * filter by Brand id.
     */
    public function withBrandID(string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

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
     * Filter by customer id.
     */
    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

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

    /**
     * Filter by product id.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * Filter by status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Filter by subscription id.
     */
    public function withSubscriptionID(string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }
}
