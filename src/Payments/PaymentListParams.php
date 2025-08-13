<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Concerns\Params;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Payments\PaymentListParams\Status;

/**
 * @phpstan-type list_params = array{
 *   brandID?: string,
 *   createdAtGte?: \DateTimeInterface,
 *   createdAtLte?: \DateTimeInterface,
 *   customerID?: string,
 *   pageNumber?: int,
 *   pageSize?: int,
 *   status?: Status::*,
 *   subscriptionID?: string,
 * }
 */
final class PaymentListParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * filter by Brand id.
     */
    #[Api(optional: true)]
    public ?string $brandID;

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
     * Filter by customer id.
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

    /**
     * Filter by subscription id.
     */
    #[Api(optional: true)]
    public ?string $subscriptionID;

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
        ?string $brandID = null,
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $customerID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?string $status = null,
        ?string $subscriptionID = null,
    ): self {
        $obj = new self;

        null !== $brandID && $obj->brandID = $brandID;
        null !== $createdAtGte && $obj->createdAtGte = $createdAtGte;
        null !== $createdAtLte && $obj->createdAtLte = $createdAtLte;
        null !== $customerID && $obj->customerID = $customerID;
        null !== $pageNumber && $obj->pageNumber = $pageNumber;
        null !== $pageSize && $obj->pageSize = $pageSize;
        null !== $status && $obj->status = $status;
        null !== $subscriptionID && $obj->subscriptionID = $subscriptionID;

        return $obj;
    }

    /**
     * filter by Brand id.
     */
    public function setBrandID(string $brandID): self
    {
        $this->brandID = $brandID;

        return $this;
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
     * Filter by customer id.
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

    /**
     * Filter by subscription id.
     */
    public function setSubscriptionID(string $subscriptionID): self
    {
        $this->subscriptionID = $subscriptionID;

        return $this;
    }
}
