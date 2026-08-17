<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type BrandArchiveResponseShape = array{
 *   archivedAt: \DateTimeInterface,
 *   brandID: string,
 *   collectionsMoved: int,
 *   productsMoved: int,
 *   subscriptionsMoved: int,
 *   movedToBrandID?: string|null,
 * }
 */
final class BrandArchiveResponse implements BaseModel
{
    /** @use SdkModel<BrandArchiveResponseShape> */
    use SdkModel;

    /**
     * Time the brand was archived.
     */
    #[Required('archived_at')]
    public \DateTimeInterface $archivedAt;

    /**
     * The archived brand.
     */
    #[Required('brand_id')]
    public string $brandID;

    /**
     * Count of product collections moved to the target brand.
     */
    #[Required('collections_moved')]
    public int $collectionsMoved;

    /**
     * Count of products moved to the target brand.
     */
    #[Required('products_moved')]
    public int $productsMoved;

    /**
     * Count of live subscriptions moved to the target brand.
     */
    #[Required('subscriptions_moved')]
    public int $subscriptionsMoved;

    /**
     * Brand that received the moved records. Null when no target was given.
     */
    #[Optional('moved_to_brand_id', nullable: true)]
    public ?string $movedToBrandID;

    /**
     * `new BrandArchiveResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandArchiveResponse::with(
     *   archivedAt: ...,
     *   brandID: ...,
     *   collectionsMoved: ...,
     *   productsMoved: ...,
     *   subscriptionsMoved: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandArchiveResponse)
     *   ->withArchivedAt(...)
     *   ->withBrandID(...)
     *   ->withCollectionsMoved(...)
     *   ->withProductsMoved(...)
     *   ->withSubscriptionsMoved(...)
     * ```
     */
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
        \DateTimeInterface $archivedAt,
        string $brandID,
        int $collectionsMoved,
        int $productsMoved,
        int $subscriptionsMoved,
        ?string $movedToBrandID = null,
    ): self {
        $self = new self;

        $self['archivedAt'] = $archivedAt;
        $self['brandID'] = $brandID;
        $self['collectionsMoved'] = $collectionsMoved;
        $self['productsMoved'] = $productsMoved;
        $self['subscriptionsMoved'] = $subscriptionsMoved;

        null !== $movedToBrandID && $self['movedToBrandID'] = $movedToBrandID;

        return $self;
    }

    /**
     * Time the brand was archived.
     */
    public function withArchivedAt(\DateTimeInterface $archivedAt): self
    {
        $self = clone $this;
        $self['archivedAt'] = $archivedAt;

        return $self;
    }

    /**
     * The archived brand.
     */
    public function withBrandID(string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    /**
     * Count of product collections moved to the target brand.
     */
    public function withCollectionsMoved(int $collectionsMoved): self
    {
        $self = clone $this;
        $self['collectionsMoved'] = $collectionsMoved;

        return $self;
    }

    /**
     * Count of products moved to the target brand.
     */
    public function withProductsMoved(int $productsMoved): self
    {
        $self = clone $this;
        $self['productsMoved'] = $productsMoved;

        return $self;
    }

    /**
     * Count of live subscriptions moved to the target brand.
     */
    public function withSubscriptionsMoved(int $subscriptionsMoved): self
    {
        $self = clone $this;
        $self['subscriptionsMoved'] = $subscriptionsMoved;

        return $self;
    }

    /**
     * Brand that received the moved records. Null when no target was given.
     */
    public function withMovedToBrandID(?string $movedToBrandID): self
    {
        $self = clone $this;
        $self['movedToBrandID'] = $movedToBrandID;

        return $self;
    }
}
