<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type OneTimeProductCartItemShape = array{
 *   productID: string, quantity: int, amount?: int|null
 * }
 */
final class OneTimeProductCartItem implements BaseModel
{
    /** @use SdkModel<OneTimeProductCartItemShape> */
    use SdkModel;

    #[Required('product_id')]
    public string $productID;

    #[Required]
    public int $quantity;

    /**
     * Amount the customer pays if pay_what_you_want is enabled. If disabled then amount will be ignored
     * Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    #[Optional(nullable: true)]
    public ?int $amount;

    /**
     * `new OneTimeProductCartItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OneTimeProductCartItem::with(productID: ..., quantity: ...)
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
        string $productID,
        int $quantity,
        ?int $amount = null
    ): self {
        $self = new self;

        $self['productID'] = $productID;
        $self['quantity'] = $quantity;

        null !== $amount && $self['amount'] = $amount;

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
     * Amount the customer pays if pay_what_you_want is enabled. If disabled then amount will be ignored
     * Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    public function withAmount(?int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }
}
