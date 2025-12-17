<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionRequest;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\AttachAddon;

/**
 * @phpstan-import-type AttachAddonShape from \Dodopayments\Subscriptions\AttachAddon
 *
 * @phpstan-type ProductCartShape = array{
 *   productID: string,
 *   quantity: int,
 *   addons?: list<AttachAddonShape>|null,
 *   amount?: int|null,
 * }
 */
final class ProductCart implements BaseModel
{
    /** @use SdkModel<ProductCartShape> */
    use SdkModel;

    /**
     * unique id of the product.
     */
    #[Required('product_id')]
    public string $productID;

    #[Required]
    public int $quantity;

    /**
     * only valid if product is a subscription.
     *
     * @var list<AttachAddon>|null $addons
     */
    #[Optional(list: AttachAddon::class, nullable: true)]
    public ?array $addons;

    /**
     * Amount the customer pays if pay_what_you_want is enabled. If disabled then amount will be ignored
     * Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     * Only applicable for one time payments.
     *
     * If amount is not set for pay_what_you_want product,
     * customer is allowed to select the amount.
     */
    #[Optional(nullable: true)]
    public ?int $amount;

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
     *
     * @param list<AttachAddonShape>|null $addons
     */
    public static function with(
        string $productID,
        int $quantity,
        ?array $addons = null,
        ?int $amount = null
    ): self {
        $self = new self;

        $self['productID'] = $productID;
        $self['quantity'] = $quantity;

        null !== $addons && $self['addons'] = $addons;
        null !== $amount && $self['amount'] = $amount;

        return $self;
    }

    /**
     * unique id of the product.
     */
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
     * only valid if product is a subscription.
     *
     * @param list<AttachAddonShape>|null $addons
     */
    public function withAddons(?array $addons): self
    {
        $self = clone $this;
        $self['addons'] = $addons;

        return $self;
    }

    /**
     * Amount the customer pays if pay_what_you_want is enabled. If disabled then amount will be ignored
     * Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     * Only applicable for one time payments.
     *
     * If amount is not set for pay_what_you_want product,
     * customer is allowed to select the amount.
     */
    public function withAmount(?int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }
}
