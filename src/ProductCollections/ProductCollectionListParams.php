<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\ProductCollectionsService::list()
 *
 * @phpstan-type ProductCollectionListParamsShape = array{
 *   archived?: bool|null,
 *   brandID?: string|null,
 *   pageNumber?: int|null,
 *   pageSize?: int|null,
 * }
 */
final class ProductCollectionListParams implements BaseModel
{
    /** @use SdkModel<ProductCollectionListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * List archived collections.
     */
    #[Optional]
    public ?bool $archived;

    /**
     * Filter by Brand id.
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
    ): self {
        $self = new self;

        null !== $archived && $self['archived'] = $archived;
        null !== $brandID && $self['brandID'] = $brandID;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * List archived collections.
     */
    public function withArchived(bool $archived): self
    {
        $self = clone $this;
        $self['archived'] = $archived;

        return $self;
    }

    /**
     * Filter by Brand id.
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
}
