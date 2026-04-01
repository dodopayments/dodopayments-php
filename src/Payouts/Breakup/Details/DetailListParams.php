<?php

declare(strict_types=1);

namespace Dodopayments\Payouts\Breakup\Details;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Returns paginated individual balance ledger entries for a payout, with each entry's amount pro-rated into the payout's currency. Supports pagination via `page_size` (default 10, max 100) and `page_number` (default 0) query parameters.
 *
 * @see Dodopayments\Services\Payouts\Breakup\DetailsService::list()
 *
 * @phpstan-type DetailListParamsShape = array{
 *   pageNumber?: int|null, pageSize?: int|null
 * }
 */
final class DetailListParams implements BaseModel
{
    /** @use SdkModel<DetailListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Page number (0-indexed). Default: 0.
     */
    #[Optional]
    public ?int $pageNumber;

    /**
     * Number of items per page. Default: 10, Max: 100.
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
        ?int $pageNumber = null,
        ?int $pageSize = null
    ): self {
        $self = new self;

        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Page number (0-indexed). Default: 0.
     */
    public function withPageNumber(int $pageNumber): self
    {
        $self = clone $this;
        $self['pageNumber'] = $pageNumber;

        return $self;
    }

    /**
     * Number of items per page. Default: 10, Max: 100.
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }
}
