<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionCreateParams;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type on_demand_alias = array{
 *   mandateOnly: bool,
 *   adaptiveCurrencyFeesInclusive?: bool|null,
 *   productCurrency?: Currency::*,
 *   productDescription?: string|null,
 *   productPrice?: int|null,
 * }
 */
final class OnDemand implements BaseModel
{
    use SdkModel;

    /**
     * If set as True, does not perform any charge and only authorizes payment method details for future use.
     */
    #[Api('mandate_only')]
    public bool $mandateOnly;

    /**
     * Whether adaptive currency fees should be included in the product_price (true) or added on top (false).
     * This field is ignored if adaptive pricing is not enabled for the business.
     */
    #[Api('adaptive_currency_fees_inclusive', optional: true)]
    public ?bool $adaptiveCurrencyFeesInclusive;

    /**
     * Optional currency of the product price. If not specified, defaults to the currency of the product.
     *
     * @var null|Currency::* $productCurrency
     */
    #[Api('product_currency', enum: Currency::class, optional: true)]
    public ?string $productCurrency;

    /**
     * Optional product description override for billing and line items.
     * If not specified, the stored description of the product will be used.
     */
    #[Api('product_description', optional: true)]
    public ?string $productDescription;

    /**
     * Product price for the initial charge to customer
     * If not specified the stored price of the product will be used
     * Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    #[Api('product_price', optional: true)]
    public ?int $productPrice;

    /**
     * `new OnDemand()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OnDemand::with(mandateOnly: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OnDemand)->withMandateOnly(...)
     * ```
     */
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
     * @param Currency::* $productCurrency
     */
    public static function with(
        bool $mandateOnly,
        ?bool $adaptiveCurrencyFeesInclusive = null,
        ?string $productCurrency = null,
        ?string $productDescription = null,
        ?int $productPrice = null,
    ): self {
        $obj = new self;

        $obj->mandateOnly = $mandateOnly;

        null !== $adaptiveCurrencyFeesInclusive && $obj->adaptiveCurrencyFeesInclusive = $adaptiveCurrencyFeesInclusive;
        null !== $productCurrency && $obj->productCurrency = $productCurrency;
        null !== $productDescription && $obj->productDescription = $productDescription;
        null !== $productPrice && $obj->productPrice = $productPrice;

        return $obj;
    }

    /**
     * If set as True, does not perform any charge and only authorizes payment method details for future use.
     */
    public function withMandateOnly(bool $mandateOnly): self
    {
        $obj = clone $this;
        $obj->mandateOnly = $mandateOnly;

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
        $obj->adaptiveCurrencyFeesInclusive = $adaptiveCurrencyFeesInclusive;

        return $obj;
    }

    /**
     * Optional currency of the product price. If not specified, defaults to the currency of the product.
     *
     * @param Currency::* $productCurrency
     */
    public function withProductCurrency(string $productCurrency): self
    {
        $obj = clone $this;
        $obj->productCurrency = $productCurrency;

        return $obj;
    }

    /**
     * Optional product description override for billing and line items.
     * If not specified, the stored description of the product will be used.
     */
    public function withProductDescription(?string $productDescription): self
    {
        $obj = clone $this;
        $obj->productDescription = $productDescription;

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
        $obj->productPrice = $productPrice;

        return $obj;
    }
}
