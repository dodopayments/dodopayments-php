<?php

declare(strict_types=1);

namespace Dodopayments\Refunds\RefundCreateParams;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ItemShape = array{
 *   itemID: string, amount?: int|null, taxInclusive?: bool|null
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    /**
     * The id of the item (i.e. `product_id` or `addon_id`).
     */
    #[Required('item_id')]
    public string $itemID;

    /**
     * The amount to refund. if None the whole item is refunded.
     */
    #[Optional(nullable: true)]
    public ?int $amount;

    /**
     * Specify if tax is inclusive of the refund. Default true.
     */
    #[Optional('tax_inclusive')]
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
        $this->initialize();
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
        $self = new self;

        $self['itemID'] = $itemID;

        null !== $amount && $self['amount'] = $amount;
        null !== $taxInclusive && $self['taxInclusive'] = $taxInclusive;

        return $self;
    }

    /**
     * The id of the item (i.e. `product_id` or `addon_id`).
     */
    public function withItemID(string $itemID): self
    {
        $self = clone $this;
        $self['itemID'] = $itemID;

        return $self;
    }

    /**
     * The amount to refund. if None the whole item is refunded.
     */
    public function withAmount(?int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Specify if tax is inclusive of the refund. Default true.
     */
    public function withTaxInclusive(bool $taxInclusive): self
    {
        $self = clone $this;
        $self['taxInclusive'] = $taxInclusive;

        return $self;
    }
}
