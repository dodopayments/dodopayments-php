<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\Groups;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\ProductCollections\Groups\GroupCreateParams\Product;

/**
 * @see Dodopayments\Services\ProductCollections\GroupsService::create()
 *
 * @phpstan-import-type ProductShape from \Dodopayments\ProductCollections\Groups\GroupCreateParams\Product
 *
 * @phpstan-type GroupCreateParamsShape = array{
 *   products: list<Product|ProductShape>,
 *   groupName?: string|null,
 *   status?: bool|null,
 * }
 */
final class GroupCreateParams implements BaseModel
{
    /** @use SdkModel<GroupCreateParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * `new GroupCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GroupCreateParams::with(products: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GroupCreateParams)->withProducts(...)
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
