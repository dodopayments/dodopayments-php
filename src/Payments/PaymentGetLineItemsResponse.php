<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\PaymentGetLineItemsResponse\Item;

/**
 * @phpstan-type PaymentGetLineItemsResponseShape = array{
 *   currency: value-of<Currency>, items: list<Item>
 * }
 */
final class PaymentGetLineItemsResponse implements BaseModel
{
    /** @use SdkModel<PaymentGetLineItemsResponseShape> */
    use SdkModel;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    /** @var list<Item> $items */
    #[Required(list: Item::class)]
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
     * @param list<Item|array{
     *   amount: int,
     *   itemsID: string,
     *   refundableAmount: int,
     *   tax: int,
     *   description?: string|null,
     *   name?: string|null,
     * }> $items
     */
    public static function with(Currency|string $currency, array $items): self
    {
        $self = new self;

        $self['currency'] = $currency;
        $self['items'] = $items;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * @param list<Item|array{
     *   amount: int,
     *   itemsID: string,
     *   refundableAmount: int,
     *   tax: int,
     *   description?: string|null,
     *   name?: string|null,
     * }> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
