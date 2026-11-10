<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Invoices\InvoiceListParams\CollectionMethod;
use Dodopayments\Invoices\InvoiceListParams\Status;
use Dodopayments\Invoices\InvoiceListParams\Tag;

/**
 * Lists invoice-led invoices, newest first. The items have no `lines` and no `payments`.
 *
 * @see Dodopayments\Services\InvoicesService::list()
 *
 * @phpstan-type InvoiceListParamsShape = array{
 *   collectionMethod?: null|\Dodopayments\Invoices\InvoiceListParams\CollectionMethod|value-of<\Dodopayments\Invoices\InvoiceListParams\CollectionMethod>,
 *   createdAtGte?: \DateTimeInterface|null,
 *   createdAtLte?: \DateTimeInterface|null,
 *   customerID?: string|null,
 *   dueAtGte?: \DateTimeInterface|null,
 *   dueAtLte?: \DateTimeInterface|null,
 *   pageNumber?: int|null,
 *   pageSize?: int|null,
 *   status?: list<Status|value-of<Status>>|null,
 *   subscriptionID?: string|null,
 *   tags?: list<Tag|value-of<Tag>>|null,
 *   totalAmountGte?: int|null,
 *   totalAmountLte?: int|null,
 * }
 */
final class InvoiceListParams implements BaseModel
{
    /** @use SdkModel<InvoiceListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * @var value-of<CollectionMethod>|null $collectionMethod
     */
    #[Optional(
        enum: CollectionMethod::class
    )]
    public ?string $collectionMethod;

    #[Optional]
    public ?\DateTimeInterface $createdAtGte;

    #[Optional]
    public ?\DateTimeInterface $createdAtLte;

    #[Optional]
    public ?string $customerID;

    #[Optional]
    public ?\DateTimeInterface $dueAtGte;

    #[Optional]
    public ?\DateTimeInterface $dueAtLte;

    /**
     * Page number. The default is 0.
     */
    #[Optional]
    public ?int $pageNumber;

    /**
     * Page size. The default is 10 and the maximum is 100.
     */
    #[Optional]
    public ?int $pageSize;

    /**
     * Repeat the key to match more than one status, for example `status=open&status=past_due`.
     *
     * @var list<value-of<Status>>|null $status
     */
    #[Optional(list: Status::class)]
    public ?array $status;

    #[Optional]
    public ?string $subscriptionID;

    /**
     * Repeat the key to match an invoice that has any one of the tags.
     *
     * @var list<value-of<Tag>>|null $tags
     */
    #[Optional(list: Tag::class)]
    public ?array $tags;

    #[Optional]
    public ?int $totalAmountGte;

    #[Optional]
    public ?int $totalAmountLte;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CollectionMethod|value-of<CollectionMethod>|null $collectionMethod
     * @param list<Status|value-of<Status>>|null $status
     * @param list<Tag|value-of<Tag>>|null $tags
     */
    public static function with(
        CollectionMethod|string|null $collectionMethod = null,
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $customerID = null,
        ?\DateTimeInterface $dueAtGte = null,
        ?\DateTimeInterface $dueAtLte = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?array $status = null,
        ?string $subscriptionID = null,
        ?array $tags = null,
        ?int $totalAmountGte = null,
        ?int $totalAmountLte = null,
    ): self {
        $self = new self;

        null !== $collectionMethod && $self['collectionMethod'] = $collectionMethod;
        null !== $createdAtGte && $self['createdAtGte'] = $createdAtGte;
        null !== $createdAtLte && $self['createdAtLte'] = $createdAtLte;
        null !== $customerID && $self['customerID'] = $customerID;
        null !== $dueAtGte && $self['dueAtGte'] = $dueAtGte;
        null !== $dueAtLte && $self['dueAtLte'] = $dueAtLte;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;
        null !== $status && $self['status'] = $status;
        null !== $subscriptionID && $self['subscriptionID'] = $subscriptionID;
        null !== $tags && $self['tags'] = $tags;
        null !== $totalAmountGte && $self['totalAmountGte'] = $totalAmountGte;
        null !== $totalAmountLte && $self['totalAmountLte'] = $totalAmountLte;

        return $self;
    }

    /**
     * @param CollectionMethod|value-of<CollectionMethod> $collectionMethod
     */
    public function withCollectionMethod(
        CollectionMethod|string $collectionMethod,
    ): self {
        $self = clone $this;
        $self['collectionMethod'] = $collectionMethod;

        return $self;
    }

    public function withCreatedAtGte(\DateTimeInterface $createdAtGte): self
    {
        $self = clone $this;
        $self['createdAtGte'] = $createdAtGte;

        return $self;
    }

    public function withCreatedAtLte(\DateTimeInterface $createdAtLte): self
    {
        $self = clone $this;
        $self['createdAtLte'] = $createdAtLte;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    public function withDueAtGte(\DateTimeInterface $dueAtGte): self
    {
        $self = clone $this;
        $self['dueAtGte'] = $dueAtGte;

        return $self;
    }

    public function withDueAtLte(\DateTimeInterface $dueAtLte): self
    {
        $self = clone $this;
        $self['dueAtLte'] = $dueAtLte;

        return $self;
    }

    /**
     * Page number. The default is 0.
     */
    public function withPageNumber(int $pageNumber): self
    {
        $self = clone $this;
        $self['pageNumber'] = $pageNumber;

        return $self;
    }

    /**
     * Page size. The default is 10 and the maximum is 100.
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Repeat the key to match more than one status, for example `status=open&status=past_due`.
     *
     * @param list<Status|value-of<Status>> $status
     */
    public function withStatus(array $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withSubscriptionID(string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    /**
     * Repeat the key to match an invoice that has any one of the tags.
     *
     * @param list<Tag|value-of<Tag>> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    public function withTotalAmountGte(int $totalAmountGte): self
    {
        $self = clone $this;
        $self['totalAmountGte'] = $totalAmountGte;

        return $self;
    }

    public function withTotalAmountLte(int $totalAmountLte): self
    {
        $self = clone $this;
        $self['totalAmountLte'] = $totalAmountLte;

        return $self;
    }
}
