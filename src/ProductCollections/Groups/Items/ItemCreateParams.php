<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\Groups\Items;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\ProductCollections\Groups\GroupProduct;

/**
 * @see Dodopayments\Services\ProductCollections\Groups\ItemsService::create()
 *
 * @phpstan-import-type GroupProductShape from \Dodopayments\ProductCollections\Groups\GroupProduct
 *
 * @phpstan-type ItemCreateParamsShape = array{
 *   id: string, products: list<GroupProduct|GroupProductShape>
 * }
 */
final class ItemCreateParams implements BaseModel
{
    /** @use SdkModel<ItemCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * Products to add to the group.
     *
     * @var list<GroupProduct> $products
     */
    #[Required(list: GroupProduct::class)]
    public array $products;

    /**
     * `new ItemCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ItemCreateParams::with(id: ..., products: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ItemCreateParams)->withID(...)->withProducts(...)
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
    public static function with(string $id, array $products): self
    {
        $self = new self;

        $self['id'] = $id;
        $self['products'] = $products;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Products to add to the group.
     *
     * @param list<GroupProduct|GroupProductShape> $products
     */
    public function withProducts(array $products): self
    {
        $self = clone $this;
        $self['products'] = $products;

        return $self;
    }
}
