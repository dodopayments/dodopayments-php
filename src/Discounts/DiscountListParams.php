<?php

declare(strict_types=1);

namespace Dodopayments\Discounts;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * GET /discounts.
 *
 * @see Dodopayments\Services\DiscountsService::list()
 *
 * @phpstan-type DiscountListParamsShape = array{
 *   page_number?: int, page_size?: int
 * }
 */
final class DiscountListParams implements BaseModel
{
    /** @use SdkModel<DiscountListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Page number (default = 0).
     */
    #[Api(optional: true)]
    public ?int $page_number;

    /**
     * Page size (default = 10, max = 100).
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
        ?int $page_number = null,
        ?int $page_size = null
    ): self {
        $obj = new self;

        null !== $page_number && $obj['page_number'] = $page_number;
        null !== $page_size && $obj['page_size'] = $page_size;

        return $obj;
    }

    /**
     * Page number (default = 0).
     */
    public function withPageNumber(int $pageNumber): self
    {
        $obj = clone $this;
        $obj['page_number'] = $pageNumber;

        return $obj;
    }

    /**
     * Page size (default = 10, max = 100).
     */
    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj['page_size'] = $pageSize;

        return $obj;
    }
}
