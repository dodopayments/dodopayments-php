<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\ProductsService::list()
 *
 * @phpstan-type ProductListParamsShape = array{
 *   archived?: bool,
 *   brandID?: string,
 *   pageNumber?: int,
 *   pageSize?: int,
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
    #[Optional]
    public ?bool $archived;

    /**
     * filter by Brand id.
     */
    #[Optional]
    public ?string $brandID;

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

    /**
     * Filter products by pricing type:
     * - `true`: Show only recurring pricing products (e.g. subscriptions)
     * - `false`: Show only one-time price products
     * - `null` or absent: Show both types of products
     */
    #[Optional]
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
        ?string $brandID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?bool $recurring = null,
    ): self {
        $self = new self;

        null !== $archived && $self['archived'] = $archived;
        null !== $brandID && $self['brandID'] = $brandID;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;
        null !== $recurring && $self['recurring'] = $recurring;

        return $self;
    }

    /**
     * List archived products.
     */
    public function withArchived(bool $archived): self
    {
        $self = clone $this;
        $self['archived'] = $archived;

        return $self;
    }

    /**
     * filter by Brand id.
     */
    public function withBrandID(string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

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

    /**
     * Filter products by pricing type:
     * - `true`: Show only recurring pricing products (e.g. subscriptions)
     * - `false`: Show only one-time price products
     * - `null` or absent: Show both types of products
     */
    public function withRecurring(bool $recurring): self
    {
        $self = clone $this;
        $self['recurring'] = $recurring;

        return $self;
    }
}
