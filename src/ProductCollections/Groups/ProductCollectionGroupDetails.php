<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\Groups;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type GroupProductShape from \Dodopayments\ProductCollections\Groups\GroupProduct
 *
 * @phpstan-type ProductCollectionGroupDetailsShape = array{
 *   products: list<GroupProduct|GroupProductShape>,
 *   groupName?: string|null,
 *   status?: bool|null,
 * }
 */
final class ProductCollectionGroupDetails implements BaseModel
{
    /** @use SdkModel<ProductCollectionGroupDetailsShape> */
    use SdkModel;

    /**
     * Products in this group.
     *
     * @var list<GroupProduct> $products
     */
    #[Required(list: GroupProduct::class)]
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
     * `new ProductCollectionGroupDetails()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductCollectionGroupDetails::with(products: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductCollectionGroupDetails)->withProducts(...)
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
     * @param list<GroupProduct|GroupProductShape> $products
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
     * @param list<GroupProduct|GroupProductShape> $products
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
