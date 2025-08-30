<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\PaymentGetLineItemsResponse\Item;

/**
 * @phpstan-type payment_get_line_items_response = array{
 *   currency: Currency::*, items: list<Item>
 * }
 */
final class PaymentGetLineItemsResponse implements BaseModel
{
    /** @use SdkModel<payment_get_line_items_response> */
    use SdkModel;

    /** @var Currency::* $currency */
    #[Api(enum: Currency::class)]
    public string $currency;

    /** @var list<Item> $items */
    #[Api(list: Item::class)]
    public array $items;

    /**
     * `new PaymentGetLineItemsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaymentGetLineItemsResponse::with(currency: ..., items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaymentGetLineItemsResponse)->withCurrency(...)->withItems(...)
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
     * @param Currency::* $currency
     * @param list<Item> $items
     */
    public static function with(string $currency, array $items): self
    {
        $obj = new self;

        $obj->currency = $currency;
        $obj->items = $items;

        return $obj;
    }

    /**
     * @param Currency::* $currency
     */
    public function withCurrency(string $currency): self
    {
        $obj = clone $this;
        $obj->currency = $currency;

        return $obj;
    }

    /**
     * @param list<Item> $items
     */
    public function withItems(array $items): self
    {
        $obj = clone $this;
        $obj->items = $items;

        return $obj;
    }
}
