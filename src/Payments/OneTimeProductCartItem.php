<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type OneTimeProductCartItemShape = array{
 *   product_id: string, quantity: int, amount?: int|null
 * }
 */
final class OneTimeProductCartItem implements BaseModel
{
    /** @use SdkModel<OneTimeProductCartItemShape> */
    use SdkModel;

    #[Api]
    public string $product_id;

    #[Api]
    public int $quantity;

    /**
     * Amount the customer pays if pay_what_you_want is enabled. If disabled then amount will be ignored
     * Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $amount;

    /**
     * `new OneTimeProductCartItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OneTimeProductCartItem::with(product_id: ..., quantity: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OneTimeProductCartItem)->withProductID(...)->withQuantity(...)
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
    public static function with(
        string $product_id,
        int $quantity,
        ?int $amount = null
    ): self {
        $obj = new self;

        $obj['product_id'] = $product_id;
        $obj['quantity'] = $quantity;

        null !== $amount && $obj['amount'] = $amount;

        return $obj;
    }

    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj['product_id'] = $productID;

        return $obj;
    }

    public function withQuantity(int $quantity): self
    {
        $obj = clone $this;
        $obj['quantity'] = $quantity;

        return $obj;
    }

    /**
     * Amount the customer pays if pay_what_you_want is enabled. If disabled then amount will be ignored
     * Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    public function withAmount(?int $amount): self
    {
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }
}
