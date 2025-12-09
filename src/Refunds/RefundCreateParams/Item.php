<?php

declare(strict_types=1);

namespace Dodopayments\Refunds\RefundCreateParams;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ItemShape = array{
 *   item_id: string, amount?: int|null, tax_inclusive?: bool|null
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    /**
     * The id of the item (i.e. `product_id` or `addon_id`).
     */
    #[Required]
    public string $item_id;

    /**
     * The amount to refund. if None the whole item is refunded.
     */
    #[Optional(nullable: true)]
    public ?int $amount;

    /**
     * Specify if tax is inclusive of the refund. Default true.
     */
    #[Optional]
    public ?bool $tax_inclusive;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(item_id: ...)
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $item_id,
        ?int $amount = null,
        ?bool $tax_inclusive = null
    ): self {
        $obj = new self;

        $obj['item_id'] = $item_id;

        null !== $amount && $obj['amount'] = $amount;
        null !== $tax_inclusive && $obj['tax_inclusive'] = $tax_inclusive;

        return $obj;
    }

    /**
     * The id of the item (i.e. `product_id` or `addon_id`).
     */
    public function withItemID(string $itemID): self
    {
        $obj = clone $this;
        $obj['item_id'] = $itemID;

        return $obj;
    }

    /**
     * The amount to refund. if None the whole item is refunded.
     */
    public function withAmount(?int $amount): self
    {
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }

    /**
     * Specify if tax is inclusive of the refund. Default true.
     */
    public function withTaxInclusive(bool $taxInclusive): self
    {
        $obj = clone $this;
        $obj['tax_inclusive'] = $taxInclusive;

        return $obj;
    }
}
