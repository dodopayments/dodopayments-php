<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionNewResponse;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type OneTimeProductCartShape = array{productID: string, quantity: int}
 */
final class OneTimeProductCart implements BaseModel
{
    /** @use SdkModel<OneTimeProductCartShape> */
    use SdkModel;

    #[Required('product_id')]
    public string $productID;

    #[Required]
    public int $quantity;

    /**
     * `new OneTimeProductCart()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OneTimeProductCart::with(productID: ..., quantity: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OneTimeProductCart)->withProductID(...)->withQuantity(...)
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
        $self = new self;

        $self['productID'] = $productID;
        $self['quantity'] = $quantity;

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
}
