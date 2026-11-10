<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\InvoiceCreateParams\Item;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\AttachAddon;

/**
 * @phpstan-import-type AttachAddonShape from \Dodopayments\Subscriptions\AttachAddon
 *
 * @phpstan-type ProductItemShape = array{
 *   productID: string,
 *   quantity: int,
 *   addons?: list<AttachAddon|AttachAddonShape>|null,
 * }
 */
final class ProductItem implements BaseModel
{
    /** @use SdkModel<ProductItemShape> */
    use SdkModel;

    #[Required('product_id')]
    public string $productID;

    #[Required]
    public int $quantity;

    /** @var list<AttachAddon>|null $addons */
    #[Optional(list: AttachAddon::class, nullable: true)]
    public ?array $addons;

    /**
     * `new ProductItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductItem::with(productID: ..., quantity: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductItem)->withProductID(...)->withQuantity(...)
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
     * @param list<AttachAddon|AttachAddonShape>|null $addons
     */
    public static function with(
        string $productID,
        int $quantity,
        ?array $addons = null
    ): self {
        $self = new self;

        $self['productID'] = $productID;
        $self['quantity'] = $quantity;

        null !== $addons && $self['addons'] = $addons;

        return $self;
    }

    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * @param list<AttachAddon|AttachAddonShape>|null $addons
     */
    public function withAddons(?array $addons): self
    {
        $self = clone $this;
        $self['addons'] = $addons;

        return $self;
    }
}
