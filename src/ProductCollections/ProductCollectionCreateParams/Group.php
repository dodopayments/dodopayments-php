<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\ProductCollectionCreateParams;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\ProductCollections\ProductCollectionCreateParams\Group\Product;

/**
 * @phpstan-import-type ProductShape from \Dodopayments\ProductCollections\ProductCollectionCreateParams\Group\Product
 *
 * @phpstan-type GroupShape = array{
 *   products: list<Product|ProductShape>,
 *   groupName?: string|null,
 *   status?: bool|null,
 * }
 */
final class Group implements BaseModel
{
    /** @use SdkModel<GroupShape> */
    use SdkModel;

    /**
     * Products in this group.
     *
     * @var list<Product> $products
     */
    #[Required(list: Product::class)]
    public array $products;

    /**
     * Optional group name. Multiple groups can have null names, but named groups must be unique per collection.
     */
    #[Optional('group_name', nullable: true)]
    public ?string $groupName;

    /**
     * Status of the group (defaults to true if not provided).
     */
    #[Optional(nullable: true)]
    public ?bool $status;

    /**
     * `new Group()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Group::with(products: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Group)->withProducts(...)
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
     * @param list<Product|ProductShape> $products
     */
    public static function with(
        array $products,
        ?string $groupName = null,
        ?bool $status = null
    ): self {
        $self = new self;

        $self['products'] = $products;

        null !== $groupName && $self['groupName'] = $groupName;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Products in this group.
     *
     * @param list<Product|ProductShape> $products
     */
    public function withProducts(array $products): self
    {
        $self = clone $this;
        $self['products'] = $products;

        return $self;
    }

    /**
     * Optional group name. Multiple groups can have null names, but named groups must be unique per collection.
     */
    public function withGroupName(?string $groupName): self
    {
        $self = clone $this;
        $self['groupName'] = $groupName;

        return $self;
    }

    /**
     * Status of the group (defaults to true if not provided).
     */
    public function withStatus(?bool $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
