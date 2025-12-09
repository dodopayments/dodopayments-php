<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type OnDemandSubscriptionShape = array{
 *   mandate_only: bool,
 *   adaptive_currency_fees_inclusive?: bool|null,
 *   product_currency?: value-of<Currency>|null,
 *   product_description?: string|null,
 *   product_price?: int|null,
 * }
 */
final class OnDemandSubscription implements BaseModel
{
    /** @use SdkModel<OnDemandSubscriptionShape> */
    use SdkModel;

    /**
     * If set as True, does not perform any charge and only authorizes payment method details for future use.
     */
    #[Required]
    public bool $mandate_only;

    /**
     * Whether adaptive currency fees should be included in the product_price (true) or added on top (false).
     * This field is ignored if adaptive pricing is not enabled for the business.
     */
    #[Optional(nullable: true)]
    public ?bool $adaptive_currency_fees_inclusive;

    /**
     * Optional currency of the product price. If not specified, defaults to the currency of the product.
     *
     * @var value-of<Currency>|null $product_currency
     */
    #[Optional(enum: Currency::class, nullable: true)]
    public ?string $product_currency;

    /**
     * Optional product description override for billing and line items.
     * If not specified, the stored description of the product will be used.
     */
    #[Optional(nullable: true)]
    public ?string $product_description;

    /**
     * Product price for the initial charge to customer
     * If not specified the stored price of the product will be used
     * Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    #[Optional(nullable: true)]
    public ?int $product_price;

    /**
     * `new OnDemandSubscription()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OnDemandSubscription::with(mandate_only: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OnDemandSubscription)->withMandateOnly(...)
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
     * @param Currency|value-of<Currency>|null $product_currency
     */
    public static function with(
        bool $mandate_only,
        ?bool $adaptive_currency_fees_inclusive = null,
        Currency|string|null $product_currency = null,
        ?string $product_description = null,
        ?int $product_price = null,
    ): self {
        $obj = new self;

        $obj['mandate_only'] = $mandate_only;

        null !== $adaptive_currency_fees_inclusive && $obj['adaptive_currency_fees_inclusive'] = $adaptive_currency_fees_inclusive;
        null !== $product_currency && $obj['product_currency'] = $product_currency;
        null !== $product_description && $obj['product_description'] = $product_description;
        null !== $product_price && $obj['product_price'] = $product_price;

        return $obj;
    }

    /**
     * If set as True, does not perform any charge and only authorizes payment method details for future use.
     */
    public function withMandateOnly(bool $mandateOnly): self
    {
        $obj = clone $this;
        $obj['mandate_only'] = $mandateOnly;

        return $obj;
    }

    /**
     * Whether adaptive currency fees should be included in the product_price (true) or added on top (false).
     * This field is ignored if adaptive pricing is not enabled for the business.
     */
    public function withAdaptiveCurrencyFeesInclusive(
        ?bool $adaptiveCurrencyFeesInclusive
    ): self {
        $obj = clone $this;
        $obj['adaptive_currency_fees_inclusive'] = $adaptiveCurrencyFeesInclusive;

        return $obj;
    }

    /**
     * Optional currency of the product price. If not specified, defaults to the currency of the product.
     *
     * @param Currency|value-of<Currency>|null $productCurrency
     */
    public function withProductCurrency(
        Currency|string|null $productCurrency
    ): self {
        $obj = clone $this;
        $obj['product_currency'] = $productCurrency;

        return $obj;
    }

    /**
     * Optional product description override for billing and line items.
     * If not specified, the stored description of the product will be used.
     */
    public function withProductDescription(?string $productDescription): self
    {
        $obj = clone $this;
        $obj['product_description'] = $productDescription;

        return $obj;
    }

    /**
     * Product price for the initial charge to customer
     * If not specified the stored price of the product will be used
     * Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    public function withProductPrice(?int $productPrice): self
    {
        $obj = clone $this;
        $obj['product_price'] = $productPrice;

        return $obj;
    }
}
