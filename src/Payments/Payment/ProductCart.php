<?php

declare(strict_types=1);

namespace Dodopayments\Payments\Payment;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProductCartShape = array{product_id: string, quantity: int}
 */
final class ProductCart implements BaseModel
{
    /** @use SdkModel<ProductCartShape> */
    use SdkModel;

    #[Api]
    public string $product_id;

    #[Api]
    public int $quantity;

    /**
     * `new ProductCart()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductCart::with(product_id: ..., quantity: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductCart)->withProductID(...)->withQuantity(...)
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
    public static function with(string $product_id, int $quantity): self
    {
        $obj = new self;

        $obj->product_id = $product_id;
        $obj->quantity = $quantity;

        return $obj;
    }

    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj->product_id = $productID;

        return $obj;
    }

    public function withQuantity(int $quantity): self
    {
        $obj = clone $this;
        $obj->quantity = $quantity;

        return $obj;
    }
}
