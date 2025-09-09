<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type on_demand_subscription = array{
 *   mandateOnly: bool,
 *   adaptiveCurrencyFeesInclusive?: bool|null,
 *   productCurrency?: value-of<Currency>|null,
 *   productDescription?: string|null,
 *   productPrice?: int|null,
 * }
 */
final class OnDemandSubscription implements BaseModel
{
    /** @use SdkModel<on_demand_subscription> */
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
    #[Api('adaptive_currency_fees_inclusive', nullable: true, optional: true)]
    public ?bool $adaptiveCurrencyFeesInclusive;

    /**
     * Optional currency of the product price. If not specified, defaults to the currency of the product.
     *
     * @var value-of<Currency>|null $productCurrency
     */
    #[Api(
        'product_currency',
        enum: Currency::class,
        nullable: true,
        optional: true
    )]
    public ?string $productCurrency;

    /**
     * Optional product description override for billing and line items.
     * If not specified, the stored description of the product will be used.
     */
    #[Api('product_description', nullable: true, optional: true)]
    public ?string $productDescription;

    /**
     * Product price for the initial charge to customer
     * If not specified the stored price of the product will be used
     * Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    #[Api('product_price', nullable: true, optional: true)]
    public ?int $productPrice;

    /**
     * `new OnDemandSubscription()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OnDemandSubscription::with(mandateOnly: ...)
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
     * @param Currency|value-of<Currency>|null $productCurrency
     */
    public static function with(
        bool $mandateOnly,
        ?bool $adaptiveCurrencyFeesInclusive = null,
        Currency|string|null $productCurrency = null,
        ?string $productDescription = null,
        ?int $productPrice = null,
    ): self {
        $obj = new self;

        $obj->mandateOnly = $mandateOnly;

        null !== $adaptiveCurrencyFeesInclusive && $obj->adaptiveCurrencyFeesInclusive = $adaptiveCurrencyFeesInclusive;
        null !== $productCurrency && $obj->productCurrency = $productCurrency instanceof Currency ? $productCurrency->value : $productCurrency;
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
     * @param Currency|value-of<Currency>|null $productCurrency
     */
    public function withProductCurrency(
        Currency|string|null $productCurrency
    ): self {
        $obj = clone $this;
        $obj->productCurrency = $productCurrency instanceof Currency ? $productCurrency->value : $productCurrency;

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
