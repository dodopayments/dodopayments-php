<?php

declare(strict_types=1);

namespace Dodopayments\Refunds\RefundCreateParams;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type item_alias = array{
 *   itemID: string, amount?: int|null, taxInclusive?: bool
 * }
 */
final class Item implements BaseModel
{
    use Model;

    /**
     * The id of the item (i.e. `product_id` or `addon_id`).
     */
    #[Api('item_id')]
    public string $itemID;

    /**
     * The amount to refund. if None the whole item is refunded.
     */
    #[Api(optional: true)]
    public ?int $amount;

    /**
     * Specify if tax is inclusive of the refund. Default true.
     */
    #[Api('tax_inclusive', optional: true)]
    public ?bool $taxInclusive;

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
    public function setItemID(string $itemID): self
    {
        $this->itemID = $itemID;

        return $this;
    }

    /**
     * The amount to refund. if None the whole item is refunded.
     */
    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Specify if tax is inclusive of the refund. Default true.
     */
    public function setTaxInclusive(bool $taxInclusive): self
    {
        $this->taxInclusive = $taxInclusive;

        return $this;
    }
}
