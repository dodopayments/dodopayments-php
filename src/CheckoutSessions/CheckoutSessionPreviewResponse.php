<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions;

use Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse\CurrentBreakup;
use Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse\ProductCart;
use Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse\RecurringBreakup;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;

/**
 * Data returned by the calculate checkout session API.
 *
 * @phpstan-import-type CurrentBreakupShape from \Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse\CurrentBreakup
 * @phpstan-import-type ProductCartShape from \Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse\ProductCart
 * @phpstan-import-type RecurringBreakupShape from \Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse\RecurringBreakup
 *
 * @phpstan-type CheckoutSessionPreviewResponseShape = array{
 *   billingCountry: CountryCode|value-of<CountryCode>,
 *   currency: Currency|value-of<Currency>,
 *   currentBreakup: CurrentBreakup|CurrentBreakupShape,
 *   productCart: list<ProductCart|ProductCartShape>,
 *   totalPrice: int,
 *   recurringBreakup?: null|RecurringBreakup|RecurringBreakupShape,
 *   taxIDErrMsg?: string|null,
 *   totalTax?: int|null,
 * }
 */
final class CheckoutSessionPreviewResponse implements BaseModel
{
    /** @use SdkModel<CheckoutSessionPreviewResponseShape> */
    use SdkModel;

    /**
     * Billing country.
     *
     * @var value-of<CountryCode> $billingCountry
     */
    #[Required('billing_country', enum: CountryCode::class)]
    public string $billingCountry;

    /**
     * Currency in which the calculations were made.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * Breakup of the current payment.
     */
    #[Required('current_breakup')]
    public CurrentBreakup $currentBreakup;

    /**
     * The total product cart.
     *
     * @var list<ProductCart> $productCart
     */
    #[Required('product_cart', list: ProductCart::class)]
    public array $productCart;

    /**
     * Total calculate price of the product cart.
     */
    #[Required('total_price')]
    public int $totalPrice;

    /**
     * Breakup of recurring payments (None for one-time only).
     */
    #[Optional('recurring_breakup', nullable: true)]
    public ?RecurringBreakup $recurringBreakup;

    /**
     * Error message if tax ID validation failed.
     */
    #[Optional('tax_id_err_msg', nullable: true)]
    public ?string $taxIDErrMsg;

    /**
     * Total tax.
     */
    #[Optional('total_tax', nullable: true)]
    public ?int $totalTax;

    /**
     * `new CheckoutSessionPreviewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckoutSessionPreviewResponse::with(
     *   billingCountry: ...,
     *   currency: ...,
     *   currentBreakup: ...,
     *   productCart: ...,
     *   totalPrice: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckoutSessionPreviewResponse)
     *   ->withBillingCountry(...)
     *   ->withCurrency(...)
     *   ->withCurrentBreakup(...)
     *   ->withProductCart(...)
     *   ->withTotalPrice(...)
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
     * @param CountryCode|value-of<CountryCode> $billingCountry
     * @param Currency|value-of<Currency> $currency
     * @param CurrentBreakup|CurrentBreakupShape $currentBreakup
     * @param list<ProductCart|ProductCartShape> $productCart
     * @param RecurringBreakup|RecurringBreakupShape|null $recurringBreakup
     */
    public static function with(
        CountryCode|string $billingCountry,
        Currency|string $currency,
        CurrentBreakup|array $currentBreakup,
        array $productCart,
        int $totalPrice,
        RecurringBreakup|array|null $recurringBreakup = null,
        ?string $taxIDErrMsg = null,
        ?int $totalTax = null,
    ): self {
        $self = new self;

        $self['billingCountry'] = $billingCountry;
        $self['currency'] = $currency;
        $self['currentBreakup'] = $currentBreakup;
        $self['productCart'] = $productCart;
        $self['totalPrice'] = $totalPrice;

        null !== $recurringBreakup && $self['recurringBreakup'] = $recurringBreakup;
        null !== $taxIDErrMsg && $self['taxIDErrMsg'] = $taxIDErrMsg;
        null !== $totalTax && $self['totalTax'] = $totalTax;

        return $self;
    }

    /**
     * Billing country.
     *
     * @param CountryCode|value-of<CountryCode> $billingCountry
     */
    public function withBillingCountry(CountryCode|string $billingCountry): self
    {
        $self = clone $this;
        $self['billingCountry'] = $billingCountry;

        return $self;
    }

    /**
     * Currency in which the calculations were made.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Breakup of the current payment.
     *
     * @param CurrentBreakup|CurrentBreakupShape $currentBreakup
     */
    public function withCurrentBreakup(
        CurrentBreakup|array $currentBreakup
    ): self {
        $self = clone $this;
        $self['currentBreakup'] = $currentBreakup;

        return $self;
    }

    /**
     * The total product cart.
     *
     * @param list<ProductCart|ProductCartShape> $productCart
     */
    public function withProductCart(array $productCart): self
    {
        $self = clone $this;
        $self['productCart'] = $productCart;

        return $self;
    }

    /**
     * Total calculate price of the product cart.
     */
    public function withTotalPrice(int $totalPrice): self
    {
        $self = clone $this;
        $self['totalPrice'] = $totalPrice;

        return $self;
    }

    /**
     * Breakup of recurring payments (None for one-time only).
     *
     * @param RecurringBreakup|RecurringBreakupShape|null $recurringBreakup
     */
    public function withRecurringBreakup(
        RecurringBreakup|array|null $recurringBreakup
    ): self {
        $self = clone $this;
        $self['recurringBreakup'] = $recurringBreakup;

        return $self;
    }

    /**
     * Error message if tax ID validation failed.
     */
    public function withTaxIDErrMsg(?string $taxIDErrMsg): self
    {
        $self = clone $this;
        $self['taxIDErrMsg'] = $taxIDErrMsg;

        return $self;
    }

    /**
     * Total tax.
     */
    public function withTotalTax(?int $totalTax): self
    {
        $self = clone $this;
        $self['totalTax'] = $totalTax;

        return $self;
    }
}
