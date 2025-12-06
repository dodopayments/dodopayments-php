<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\ProductsService::list()
 *
 * @phpstan-type ProductListParamsShape = array{
 *   archived?: bool,
 *   brand_id?: string,
 *   page_number?: int,
 *   page_size?: int,
 *   recurring?: bool,
 * }
 */
final class ProductListParams implements BaseModel
{
    /** @use SdkModel<ProductListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * List archived products.
     */
    #[Api(optional: true)]
    public ?bool $archived;

    /**
     * filter by Brand id.
     */
    #[Api(optional: true)]
    public ?string $brand_id;

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

    /**
     * Filter products by pricing type:
     * - `true`: Show only recurring pricing products (e.g. subscriptions)
     * - `false`: Show only one-time price products
     * - `null` or absent: Show both types of products
     */
    #[Api(optional: true)]
    public ?bool $recurring;

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
        ?bool $archived = null,
        ?string $brand_id = null,
        ?int $page_number = null,
        ?int $page_size = null,
        ?bool $recurring = null,
    ): self {
        $obj = new self;

        null !== $archived && $obj['archived'] = $archived;
        null !== $brand_id && $obj['brand_id'] = $brand_id;
        null !== $page_number && $obj['page_number'] = $page_number;
        null !== $page_size && $obj['page_size'] = $page_size;
        null !== $recurring && $obj['recurring'] = $recurring;

        return $obj;
    }

    /**
     * List archived products.
     */
    public function withArchived(bool $archived): self
    {
        $obj = clone $this;
        $obj['archived'] = $archived;

        return $obj;
    }

    /**
     * filter by Brand id.
     */
    public function withBrandID(string $brandID): self
    {
        $obj = clone $this;
        $obj['brand_id'] = $brandID;

        return $obj;
    }

    /**
     * Page number default is 0.
     */
    public function withPageNumber(int $pageNumber): self
    {
        $obj = clone $this;
        $obj['page_number'] = $pageNumber;

        return $obj;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj['page_size'] = $pageSize;

        return $obj;
    }

    /**
     * Filter products by pricing type:
     * - `true`: Show only recurring pricing products (e.g. subscriptions)
     * - `false`: Show only one-time price products
     * - `null` or absent: Show both types of products
     */
    public function withRecurring(bool $recurring): self
    {
        $obj = clone $this;
        $obj['recurring'] = $recurring;

        return $obj;
    }
}
