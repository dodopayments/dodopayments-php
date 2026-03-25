<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\ProductCollectionGetResponse;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\ProductCollections\ProductCollectionGetResponse\Group\Product;

/**
 * @phpstan-import-type ProductShape from \Dodopayments\ProductCollections\ProductCollectionGetResponse\Group\Product
 *
 * @phpstan-type GroupShape = array{
 *   groupID: string,
 *   products: list<Product|ProductShape>,
 *   status: bool,
 *   groupName?: string|null,
 * }
 */
final class Group implements BaseModel
{
    /** @use SdkModel<GroupShape> */
    use SdkModel;

    #[Required('group_id')]
    public string $groupID;

    /** @var list<Product> $products */
    #[Required(list: Product::class)]
    public array $products;

    #[Required]
    public bool $status;

    #[Optional('group_name', nullable: true)]
    public ?string $groupName;

    /**
     * `new Group()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Group::with(groupID: ..., products: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Group)->withGroupID(...)->withProducts(...)->withStatus(...)
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
        string $groupID,
        array $products,
        bool $status,
        ?string $groupName = null
    ): self {
        $self = new self;

        $self['groupID'] = $groupID;
        $self['products'] = $products;
        $self['status'] = $status;

        null !== $groupName && $self['groupName'] = $groupName;

        return $self;
    }

    public function withGroupID(string $groupID): self
    {
        $self = clone $this;
        $self['groupID'] = $groupID;

        return $self;
    }

    /**
     * @param list<Product|ProductShape> $products
     */
    public function withProducts(array $products): self
    {
        $self = clone $this;
        $self['products'] = $products;

        return $self;
    }

    public function withStatus(bool $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withGroupName(?string $groupName): self
    {
        $self = clone $this;
        $self['groupName'] = $groupName;

        return $self;
    }
}
