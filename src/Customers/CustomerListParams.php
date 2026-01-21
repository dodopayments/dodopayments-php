<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\CustomersService::list()
 *
 * @phpstan-type CustomerListParamsShape = array{
 *   createdAtGte?: \DateTimeInterface|null,
 *   createdAtLte?: \DateTimeInterface|null,
 *   email?: string|null,
 *   name?: string|null,
 *   pageNumber?: int|null,
 *   pageSize?: int|null,
 * }
 */
final class CustomerListParams implements BaseModel
{
    /** @use SdkModel<CustomerListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter customers created on or after this timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAtGte;

    /**
     * Filter customers created on or before this timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAtLte;

    /**
     * Filter by customer email.
     */
    #[Optional]
    public ?string $email;

    /**
     * Filter by customer name (partial match, case-insensitive).
     */
    #[Optional]
    public ?string $name;

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
     */
    public static function with(
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $email = null,
        ?string $name = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
    ): self {
        $self = new self;

        null !== $createdAtGte && $self['createdAtGte'] = $createdAtGte;
        null !== $createdAtLte && $self['createdAtLte'] = $createdAtLte;
        null !== $email && $self['email'] = $email;
        null !== $name && $self['name'] = $name;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Filter customers created on or after this timestamp.
     */
    public function withCreatedAtGte(\DateTimeInterface $createdAtGte): self
    {
        $self = clone $this;
        $self['createdAtGte'] = $createdAtGte;

        return $self;
    }

    /**
     * Filter customers created on or before this timestamp.
     */
    public function withCreatedAtLte(\DateTimeInterface $createdAtLte): self
    {
        $self = clone $this;
        $self['createdAtLte'] = $createdAtLte;

        return $self;
    }

    /**
     * Filter by customer email.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Filter by customer name (partial match, case-insensitive).
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

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
