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
 *   isByop: bool,
 *   productCart: list<ProductCart|ProductCartShape>,
 *   totalPrice: int,
 *   recurringBreakup?: null|RecurringBreakup|RecurringBreakupShape,
 *   taxIDBusinessName?: string|null,
 *   taxIDErrMsg?: string|null,
 *   taxIDFormatName?: string|null,
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
     * Whether the payment will be routed through the merchant's own
     * processor (BYOP). True when the session's business has a BYOP route
     * configured for the billing country; in that case the quoted amounts
     * exclude Dodo-computed tax because the merchant is MoR and owns tax.
     */
    #[Required('is_byop')]
    public bool $isByop;

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
     * Registered business name from the official registry (EU/GB/AU) when found.
     */
    #[Optional('tax_id_business_name', nullable: true)]
    public ?string $taxIDBusinessName;

    /**
     * Error message if tax ID validation failed.
     */
    #[Optional('tax_id_err_msg', nullable: true)]
    public ?string $taxIDErrMsg;

    /**
     * The matched tax ID notation (e.g. "VAT Number", "GSTIN") when valid.
     */
    #[Optional('tax_id_format_name', nullable: true)]
    public ?string $taxIDFormatName;

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
     *   isByop: ...,
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
     *   ->withIsByop(...)
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
        bool $isByop,
        array $productCart,
        int $totalPrice,
        RecurringBreakup|array|null $recurringBreakup = null,
        ?string $taxIDBusinessName = null,
        ?string $taxIDErrMsg = null,
        ?string $taxIDFormatName = null,
        ?int $totalTax = null,
    ): self {
        $self = new self;

        $self['billingCountry'] = $billingCountry;
        $self['currency'] = $currency;
        $self['currentBreakup'] = $currentBreakup;
        $self['isByop'] = $isByop;
        $self['productCart'] = $productCart;
        $self['totalPrice'] = $totalPrice;

        null !== $recurringBreakup && $self['recurringBreakup'] = $recurringBreakup;
        null !== $taxIDBusinessName && $self['taxIDBusinessName'] = $taxIDBusinessName;
        null !== $taxIDErrMsg && $self['taxIDErrMsg'] = $taxIDErrMsg;
        null !== $taxIDFormatName && $self['taxIDFormatName'] = $taxIDFormatName;
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
     * Whether the payment will be routed through the merchant's own
     * processor (BYOP). True when the session's business has a BYOP route
     * configured for the billing country; in that case the quoted amounts
     * exclude Dodo-computed tax because the merchant is MoR and owns tax.
     */
    public function withIsByop(bool $isByop): self
    {
        $self = clone $this;
        $self['isByop'] = $isByop;

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
     * Registered business name from the official registry (EU/GB/AU) when found.
     */
    public function withTaxIDBusinessName(?string $taxIDBusinessName): self
    {
        $self = clone $this;
        $self['taxIDBusinessName'] = $taxIDBusinessName;

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
     * The matched tax ID notation (e.g. "VAT Number", "GSTIN") when valid.
     */
    public function withTaxIDFormatName(?string $taxIDFormatName): self
    {
        $self = clone $this;
        $self['taxIDFormatName'] = $taxIDFormatName;

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
