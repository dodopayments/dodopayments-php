<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\PaymentGetLineItemsResponse\Item;

/**
 * @phpstan-import-type ItemShape from \Dodopayments\Payments\PaymentGetLineItemsResponse\Item
 *
 * @phpstan-type PaymentGetLineItemsResponseShape = array{
 *   currency: Currency|value-of<Currency>,
 *   items: list<Item|ItemShape>,
 *   partialRefundAllowed: bool,
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
     * False when the payment method does not allow a partial refund of this payment.
     */
    #[Required('partial_refund_allowed')]
    public bool $partialRefundAllowed;

    /**
     * `new PaymentGetLineItemsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaymentGetLineItemsResponse::with(
     *   currency: ..., items: ..., partialRefundAllowed: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaymentGetLineItemsResponse)
     *   ->withCurrency(...)
     *   ->withItems(...)
     *   ->withPartialRefundAllowed(...)
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
     * @param list<Item|ItemShape> $items
     */
    public static function with(
        Currency|string $currency,
        array $items,
        bool $partialRefundAllowed
    ): self {
        $self = new self;

        $self['currency'] = $currency;
        $self['items'] = $items;
        $self['partialRefundAllowed'] = $partialRefundAllowed;

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
     * @param list<Item|ItemShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * False when the payment method does not allow a partial refund of this payment.
     */
    public function withPartialRefundAllowed(bool $partialRefundAllowed): self
    {
        $self = clone $this;
        $self['partialRefundAllowed'] = $partialRefundAllowed;

        return $self;
    }
}
