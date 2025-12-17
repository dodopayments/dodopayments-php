<?php

declare(strict_types=1);

namespace Dodopayments\Payouts;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\PayoutsService::list()
 *
 * @phpstan-type PayoutListParamsShape = array{
 *   createdAtGte?: \DateTimeInterface|null,
 *   createdAtLte?: \DateTimeInterface|null,
 *   pageNumber?: int|null,
 *   pageSize?: int|null,
 * }
 */
final class PayoutListParams implements BaseModel
{
    /** @use SdkModel<PayoutListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Get payouts created after this time (inclusive).
     */
    #[Optional]
    public ?\DateTimeInterface $createdAtGte;

    /**
     * Get payouts created before this time (inclusive).
     */
    #[Optional]
    public ?\DateTimeInterface $createdAtLte;

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
        ?int $pageNumber = null,
        ?int $pageSize = null,
    ): self {
        $self = new self;

        null !== $createdAtGte && $self['createdAtGte'] = $createdAtGte;
        null !== $createdAtLte && $self['createdAtLte'] = $createdAtLte;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Get payouts created after this time (inclusive).
     */
    public function withCreatedAtGte(\DateTimeInterface $createdAtGte): self
    {
        $self = clone $this;
        $self['createdAtGte'] = $createdAtGte;

        return $self;
    }

    /**
     * Get payouts created before this time (inclusive).
     */
    public function withCreatedAtLte(\DateTimeInterface $createdAtLte): self
    {
        $self = clone $this;
        $self['createdAtLte'] = $createdAtLte;

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
