<?php

declare(strict_types=1);

namespace Dodopayments\Payments\PaymentGetLineItemsResponse;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ItemShape = array{
 *   amount: int,
 *   items_id: string,
 *   refundable_amount: int,
 *   tax: int,
 *   description?: string|null,
 *   name?: string|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    #[Api]
    public int $amount;

    #[Api]
    public string $items_id;

    #[Api]
    public int $refundable_amount;

    #[Api]
    public int $tax;

    #[Api(nullable: true, optional: true)]
    public ?string $description;

    #[Api(nullable: true, optional: true)]
    public ?string $name;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(amount: ..., items_id: ..., refundable_amount: ..., tax: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)
     *   ->withAmount(...)
     *   ->withItemsID(...)
     *   ->withRefundableAmount(...)
     *   ->withTax(...)
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
        int $amount,
        string $items_id,
        int $refundable_amount,
        int $tax,
        ?string $description = null,
        ?string $name = null,
    ): self {
        $obj = new self;

        $obj->amount = $amount;
        $obj->items_id = $items_id;
        $obj->refundable_amount = $refundable_amount;
        $obj->tax = $tax;

        null !== $description && $obj->description = $description;
        null !== $name && $obj->name = $name;

        return $obj;
    }

    public function withAmount(int $amount): self
    {
        $obj = clone $this;
        $obj->amount = $amount;

        return $obj;
    }

    public function withItemsID(string $itemsID): self
    {
        $obj = clone $this;
        $obj->items_id = $itemsID;

        return $obj;
    }

    public function withRefundableAmount(int $refundableAmount): self
    {
        $obj = clone $this;
        $obj->refundable_amount = $refundableAmount;

        return $obj;
    }

    public function withTax(int $tax): self
    {
        $obj = clone $this;
        $obj->tax = $tax;

        return $obj;
    }

    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }
}
