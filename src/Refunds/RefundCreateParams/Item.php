<?php

declare(strict_types=1);

namespace Dodopayments\Refunds\RefundCreateParams;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

final class Item implements BaseModel
{
    use SdkModel;

    /**
     * The id of the item (i.e. `product_id` or `addon_id`).
     */
    #[Api('item_id')]
    public string $itemID;

    /**
     * The amount to refund. if None the whole item is refunded.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $amount;

    /**
     * Specify if tax is inclusive of the refund. Default true.
     */
    #[Api('tax_inclusive', optional: true)]
    public ?bool $taxInclusive;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(itemID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)->withItemID(...)
     * ```
     */
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
    public static function with(
        string $itemID,
        ?int $amount = null,
        ?bool $taxInclusive = null
    ): self {
        $obj = new self;

        $obj->itemID = $itemID;

        null !== $amount && $obj->amount = $amount;
        null !== $taxInclusive && $obj->taxInclusive = $taxInclusive;

        return $obj;
    }

    /**
     * The id of the item (i.e. `product_id` or `addon_id`).
     */
    public function withItemID(string $itemID): self
    {
        $obj = clone $this;
        $obj->itemID = $itemID;

        return $obj;
    }

    /**
     * The amount to refund. if None the whole item is refunded.
     */
    public function withAmount(?int $amount): self
    {
        $obj = clone $this;
        $obj->amount = $amount;

        return $obj;
    }

    /**
     * Specify if tax is inclusive of the refund. Default true.
     */
    public function withTaxInclusive(bool $taxInclusive): self
    {
        $obj = clone $this;
        $obj->taxInclusive = $taxInclusive;

        return $obj;
    }
}
