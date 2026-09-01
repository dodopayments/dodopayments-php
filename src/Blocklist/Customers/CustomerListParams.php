<?php

declare(strict_types=1);

namespace Dodopayments\Blocklist\Customers;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\Blocklist\CustomersService::list()
 *
 * @phpstan-type CustomerListParamsShape = array{
 *   blockedByEmail?: string|null,
 *   createdAtGte?: \DateTimeInterface|null,
 *   createdAtLte?: \DateTimeInterface|null,
 *   identifier?: string|null,
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
     * Filter by the dashboard user who blocked the customer.
     */
    #[Optional(nullable: true)]
    public ?string $blockedByEmail;

    /**
     * Blocked on or after this time.
     */
    #[Optional(nullable: true)]
    public ?\DateTimeInterface $createdAtGte;

    /**
     * Blocked on or before this time.
     */
    #[Optional(nullable: true)]
    public ?\DateTimeInterface $createdAtLte;

    /**
     * Partial, case-insensitive match on the email and on the customer id.
     */
    #[Optional(nullable: true)]
    public ?string $identifier;

    /**
     * Page number. Default 0.
     */
    #[Optional(nullable: true)]
    public ?int $pageNumber;

    /**
     * Page size. Default 10, maximum 100.
     */
    #[Optional(nullable: true)]
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
        ?string $blockedByEmail = null,
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $identifier = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
    ): self {
        $self = new self;

        null !== $blockedByEmail && $self['blockedByEmail'] = $blockedByEmail;
        null !== $createdAtGte && $self['createdAtGte'] = $createdAtGte;
        null !== $createdAtLte && $self['createdAtLte'] = $createdAtLte;
        null !== $identifier && $self['identifier'] = $identifier;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Filter by the dashboard user who blocked the customer.
     */
    public function withBlockedByEmail(?string $blockedByEmail): self
    {
        $self = clone $this;
        $self['blockedByEmail'] = $blockedByEmail;

        return $self;
    }

    /**
     * Blocked on or after this time.
     */
    public function withCreatedAtGte(?\DateTimeInterface $createdAtGte): self
    {
        $self = clone $this;
        $self['createdAtGte'] = $createdAtGte;

        return $self;
    }

    /**
     * Blocked on or before this time.
     */
    public function withCreatedAtLte(?\DateTimeInterface $createdAtLte): self
    {
        $self = clone $this;
        $self['createdAtLte'] = $createdAtLte;

        return $self;
    }

    /**
     * Partial, case-insensitive match on the email and on the customer id.
     */
    public function withIdentifier(?string $identifier): self
    {
        $self = clone $this;
        $self['identifier'] = $identifier;

        return $self;
    }

    /**
     * Page number. Default 0.
     */
    public function withPageNumber(?int $pageNumber): self
    {
        $self = clone $this;
        $self['pageNumber'] = $pageNumber;

        return $self;
    }

    /**
     * Page size. Default 10, maximum 100.
     */
    public function withPageSize(?int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }
}
