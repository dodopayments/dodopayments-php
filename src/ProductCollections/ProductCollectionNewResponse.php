<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\ProductCollections\ProductCollectionNewResponse\Group;

/**
 * @phpstan-import-type GroupShape from \Dodopayments\ProductCollections\ProductCollectionNewResponse\Group
 *
 * @phpstan-type ProductCollectionNewResponseShape = array{
 *   id: string,
 *   brandID: string,
 *   createdAt: \DateTimeInterface,
 *   groups: list<Group|GroupShape>,
 *   name: string,
 *   updatedAt: \DateTimeInterface,
 *   description?: string|null,
 *   image?: string|null,
 * }
 */
final class ProductCollectionNewResponse implements BaseModel
{
    /** @use SdkModel<ProductCollectionNewResponseShape> */
    use SdkModel;

    /**
     * Unique identifier for the product collection.
     */
    #[Required]
    public string $id;

    /**
     * Brand ID for the collection.
     */
    #[Required('brand_id')]
    public string $brandID;

    /**
     * Timestamp when the collection was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Groups in this collection.
     *
     * @var list<Group> $groups
     */
    #[Required(list: Group::class)]
    public array $groups;

    /**
     * Name of the collection.
     */
    #[Required]
    public string $name;

    /**
     * Timestamp when the collection was last updated.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Description of the collection.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * URL of the collection image.
     */
    #[Optional(nullable: true)]
    public ?string $image;

    /**
     * `new ProductCollectionNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductCollectionNewResponse::with(
     *   id: ..., brandID: ..., createdAt: ..., groups: ..., name: ..., updatedAt: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductCollectionNewResponse)
     *   ->withID(...)
     *   ->withBrandID(...)
     *   ->withCreatedAt(...)
     *   ->withGroups(...)
     *   ->withName(...)
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
     *
     * @param list<Group|GroupShape> $groups
     */
    public static function with(
        string $id,
        string $brandID,
        \DateTimeInterface $createdAt,
        array $groups,
        string $name,
        \DateTimeInterface $updatedAt,
        ?string $description = null,
        ?string $image = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['brandID'] = $brandID;
        $self['createdAt'] = $createdAt;
        $self['groups'] = $groups;
        $self['name'] = $name;
        $self['updatedAt'] = $updatedAt;

        null !== $description && $self['description'] = $description;
        null !== $image && $self['image'] = $image;

        return $self;
    }

    /**
     * Unique identifier for the product collection.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Brand ID for the collection.
     */
    public function withBrandID(string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    /**
     * Timestamp when the collection was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Groups in this collection.
     *
     * @param list<Group|GroupShape> $groups
     */
    public function withGroups(array $groups): self
    {
        $self = clone $this;
        $self['groups'] = $groups;

        return $self;
    }

    /**
     * Name of the collection.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Timestamp when the collection was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Description of the collection.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * URL of the collection image.
     */
    public function withImage(?string $image): self
    {
        $self = clone $this;
        $self['image'] = $image;

        return $self;
    }
}
