<?php

declare(strict_types=1);

namespace Dodopayments\Payouts;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Payouts->list
 *
 * @phpstan-type payout_list_params = array{
 *   createdAtGte?: \DateTimeInterface,
 *   createdAtLte?: \DateTimeInterface,
 *   pageNumber?: int,
 *   pageSize?: int,
 * }
 */
final class PayoutListParams implements BaseModel
{
    /** @use SdkModel<payout_list_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Get payouts created after this time (inclusive).
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $createdAtGte;

    /**
     * Get payouts created before this time (inclusive).
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $createdAtLte;

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
        $obj = new self;

        null !== $createdAtGte && $obj->createdAtGte = $createdAtGte;
        null !== $createdAtLte && $obj->createdAtLte = $createdAtLte;
        null !== $pageNumber && $obj->pageNumber = $pageNumber;
        null !== $pageSize && $obj->pageSize = $pageSize;

        return $obj;
    }

    /**
     * Get payouts created after this time (inclusive).
     */
    public function withCreatedAtGte(\DateTimeInterface $createdAtGte): self
    {
        $obj = clone $this;
        $obj->createdAtGte = $createdAtGte;

        return $obj;
    }

    /**
     * Get payouts created before this time (inclusive).
     */
    public function withCreatedAtLte(\DateTimeInterface $createdAtLte): self
    {
        $obj = clone $this;
        $obj->createdAtLte = $createdAtLte;

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
}
