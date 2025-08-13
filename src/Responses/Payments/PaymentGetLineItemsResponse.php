<?php

declare(strict_types=1);

namespace Dodopayments\Responses\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\Misc\Currency;
use Dodopayments\Responses\Payments\PaymentGetLineItemsResponse\Item;

/**
 * @phpstan-type payment_get_line_items_response_alias = array{
 *   currency: Currency::*, items: list<Item>
 * }
 */
final class PaymentGetLineItemsResponse implements BaseModel
{
    use Model;

    /** @var Currency::* $currency */
    #[Api(enum: Currency::class)]
    public string $currency;

    /** @var list<Item> $items */
    #[Api(type: new ListOf(Item::class))]
    public array $items;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Currency::* $currency
     * @param list<Item> $items
     */
    public static function from(string $currency, array $items): self
    {
        $obj = new self;

        $obj->currency = $currency;
        $obj->items = $items;

        return $obj;
    }

    /**
     * @param Currency::* $currency
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @param list<Item> $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }
}
