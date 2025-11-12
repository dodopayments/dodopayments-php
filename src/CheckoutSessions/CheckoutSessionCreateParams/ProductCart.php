<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionCreateParams;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\AttachAddon;

/**
 * @phpstan-type ProductCartShape = array{
 *   product_id: string,
 *   quantity: int,
 *   addons?: list<AttachAddon>|null,
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
    #[Api]
    public string $product_id;

    #[Api]
    public int $quantity;

    /**
     * only valid if product is a subscription.
     *
     * @var list<AttachAddon>|null $addons
     */
    #[Api(list: AttachAddon::class, nullable: true, optional: true)]
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
    #[Api(nullable: true, optional: true)]
    public ?int $amount;

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
     *
     * @param list<AttachAddon>|null $addons
     */
    public static function with(
        string $product_id,
        int $quantity,
        ?array $addons = null,
        ?int $amount = null,
    ): self {
        $obj = new self;

        $obj->product_id = $product_id;
        $obj->quantity = $quantity;

        null !== $addons && $obj->addons = $addons;
        null !== $amount && $obj->amount = $amount;

        return $obj;
    }

    /**
     * unique id of the product.
     */
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

    /**
     * only valid if product is a subscription.
     *
     * @param list<AttachAddon>|null $addons
     */
    public function withAddons(?array $addons): self
    {
        $obj = clone $this;
        $obj->addons = $addons;

        return $obj;
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
        $obj = clone $this;
        $obj->amount = $amount;

        return $obj;
    }
}
