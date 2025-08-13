<?php

declare(strict_types=1);

namespace DodoPayments\Payments\Payment;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type product_cart_alias = array{productID: string, quantity: int}
 */
final class ProductCart implements BaseModel
{
    use Model;

    #[Api('product_id')]
    public string $productID;

    #[Api]
    public int $quantity;

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
    public static function from(string $productID, int $quantity): self
    {
        $obj = new self;

        $obj->productID = $productID;
        $obj->quantity = $quantity;

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
}
