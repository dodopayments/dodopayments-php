<?php

declare(strict_types=1);

namespace Dodopayments\Payouts;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\PayoutsService::list()
 *
 * @phpstan-type PayoutListParamsShape = array{
 *   created_at_gte?: \DateTimeInterface,
 *   created_at_lte?: \DateTimeInterface,
 *   page_number?: int,
 *   page_size?: int,
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
    #[Api(optional: true)]
    public ?\DateTimeInterface $created_at_gte;

    /**
     * Get payouts created before this time (inclusive).
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $created_at_lte;

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
        ?\DateTimeInterface $created_at_gte = null,
        ?\DateTimeInterface $created_at_lte = null,
        ?int $page_number = null,
        ?int $page_size = null,
    ): self {
        $obj = new self;

        null !== $created_at_gte && $obj->created_at_gte = $created_at_gte;
        null !== $created_at_lte && $obj->created_at_lte = $created_at_lte;
        null !== $page_number && $obj->page_number = $page_number;
        null !== $page_size && $obj->page_size = $page_size;

        return $obj;
    }

    /**
     * Get payouts created after this time (inclusive).
     */
    public function withCreatedAtGte(\DateTimeInterface $createdAtGte): self
    {
        $obj = clone $this;
        $obj->created_at_gte = $createdAtGte;

        return $obj;
    }

    /**
     * Get payouts created before this time (inclusive).
     */
    public function withCreatedAtLte(\DateTimeInterface $createdAtLte): self
    {
        $obj = clone $this;
        $obj->created_at_lte = $createdAtLte;

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
}
