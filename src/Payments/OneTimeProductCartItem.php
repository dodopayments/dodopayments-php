<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type one_time_product_cart_item_alias = array{
 *   productID: string, quantity: int, amount?: int|null
 * }
 */
final class OneTimeProductCartItem implements BaseModel
{
    use Model;

    #[Api('product_id')]
    public string $productID;

    #[Api]
    public int $quantity;

    /**
     * Amount the customer pays if pay_what_you_want is enabled. If disabled then amount will be ignored
     * Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    #[Api(optional: true)]
    public ?int $amount;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function from(
        string $productID,
        int $quantity,
        ?int $amount = null
    ): self {
        $obj = new self;

        $obj->productID = $productID;
        $obj->quantity = $quantity;

        null !== $amount && $obj->amount = $amount;

        return $obj;
    }

    public function setProductID(string $productID): self
    {
        $this->productID = $productID;

        return $this;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Amount the customer pays if pay_what_you_want is enabled. If disabled then amount will be ignored
     * Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
