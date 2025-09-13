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
 *   currency: value-of<Currency>, items: list<Item>
 * }
 * When used in a response, this type parameter can be used to define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class PaymentGetLineItemsResponse implements BaseModel
{
    /** @use SdkModel<payment_get_line_items_response> */
    use SdkModel;

    /** @var value-of<Currency> $currency */
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
     * @param Currency|value-of<Currency> $currency
     * @param list<Item> $items
     */
    public static function with(Currency|string $currency, array $items): self
    {
        $obj = new self;

        $obj->currency = $currency instanceof Currency ? $currency->value : $currency;
        $obj->items = $items;

        return $obj;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $obj = clone $this;
        $obj->currency = $currency instanceof Currency ? $currency->value : $currency;

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
