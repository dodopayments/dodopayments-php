<?php

declare(strict_types=1);

namespace Dodopayments\Payments\Payment;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type product_cart = array{productID: string, quantity: int}
 */
final class ProductCart implements BaseModel
{
    /** @use SdkModel<product_cart> */
    use SdkModel;

    #[Api('product_id')]
    public string $productID;

    #[Api]
    public int $quantity;

    /**
     * `new ProductCart()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductCart::with(productID: ..., quantity: ...)
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
    public static function with(string $productID, int $quantity): self
    {
        $obj = new self;

        $obj->productID = $productID;
        $obj->quantity = $quantity;

        return $obj;
    }

    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj->productID = $productID;

        return $obj;
    }

    public function withQuantity(int $quantity): self
    {
        $obj = clone $this;
        $obj->quantity = $quantity;

        return $obj;
    }
}
