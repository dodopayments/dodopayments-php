<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\ProductCollections\ProductCollectionCreateParams\Group;

/**
 * @see Dodopayments\Services\ProductCollectionsService::create()
 *
 * @phpstan-import-type GroupShape from \Dodopayments\ProductCollections\ProductCollectionCreateParams\Group
 *
 * @phpstan-type ProductCollectionCreateParamsShape = array{
 *   groups: list<Group|GroupShape>,
 *   name: string,
 *   brandID?: string|null,
 *   description?: string|null,
 * }
 */
final class ProductCollectionCreateParams implements BaseModel
{
    /** @use SdkModel<ProductCollectionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Groups of products in this collection.
     *
     * @var list<Group> $groups
     */
    #[Required(list: Group::class)]
    public array $groups;

    /**
     * Name of the product collection.
     */
    #[Required]
    public string $name;

    /**
     * Brand id for the collection, if not provided will default to primary brand.
     */
    #[Optional('brand_id', nullable: true)]
    public ?string $brandID;

    /**
     * Optional description of the product collection.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * `new ProductCollectionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductCollectionCreateParams::with(groups: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductCollectionCreateParams)->withGroups(...)->withName(...)
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
        array $groups,
        string $name,
        ?string $brandID = null,
        ?string $description = null,
    ): self {
        $self = new self;

        $self['groups'] = $groups;
        $self['name'] = $name;

        null !== $brandID && $self['brandID'] = $brandID;
        null !== $description && $self['description'] = $description;

        return $self;
    }

    /**
     * Groups of products in this collection.
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
     * Name of the product collection.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Brand id for the collection, if not provided will default to primary brand.
     */
    public function withBrandID(?string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    /**
     * Optional description of the product collection.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
