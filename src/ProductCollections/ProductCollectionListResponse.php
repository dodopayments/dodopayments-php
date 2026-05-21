<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProductCollectionListResponseShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   name: string,
 *   productsCount: int,
 *   updatedAt: \DateTimeInterface,
 *   description?: string|null,
 *   image?: string|null,
 * }
 */
final class ProductCollectionListResponse implements BaseModel
{
    /** @use SdkModel<ProductCollectionListResponseShape> */
    use SdkModel;

    /**
     * Collection ID.
     */
    #[Required]
    public string $id;

    /**
     * Timestamp when created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Collection name.
     */
    #[Required]
    public string $name;

    /**
     * Number of products in the collection.
     */
    #[Required('products_count')]
    public int $productsCount;

    /**
     * Timestamp when last updated.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Collection description.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Collection image URL.
     */
    #[Optional(nullable: true)]
    public ?string $image;

    /**
     * `new ProductCollectionListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductCollectionListResponse::with(
     *   id: ..., createdAt: ..., name: ..., productsCount: ..., updatedAt: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductCollectionListResponse)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withName(...)
     *   ->withProductsCount(...)
     *   ->withUpdatedAt(...)
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
        string $id,
        \DateTimeInterface $createdAt,
        string $name,
        int $productsCount,
        \DateTimeInterface $updatedAt,
        ?string $description = null,
        ?string $image = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['name'] = $name;
        $self['productsCount'] = $productsCount;
        $self['updatedAt'] = $updatedAt;

        null !== $description && $self['description'] = $description;
        null !== $image && $self['image'] = $image;

        return $self;
    }

    /**
     * Collection ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Timestamp when created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Collection name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Number of products in the collection.
     */
    public function withProductsCount(int $productsCount): self
    {
        $self = clone $this;
        $self['productsCount'] = $productsCount;

        return $self;
    }

    /**
     * Timestamp when last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Collection description.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Collection image URL.
     */
    public function withImage(?string $image): self
    {
        $self = clone $this;
        $self['image'] = $image;

        return $self;
    }
}
