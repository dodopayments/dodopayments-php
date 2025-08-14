<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Concerns\Params;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\MapOf;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type charge_params = array{
 *   productPrice: int,
 *   adaptiveCurrencyFeesInclusive?: bool|null,
 *   metadata?: array<string, string>|null,
 *   productCurrency?: Currency::*,
 *   productDescription?: string|null,
 * }
 */
final class SubscriptionChargeParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * The product price. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    #[Api('product_price')]
    public int $productPrice;

    /**
     * Whether adaptive currency fees should be included in the product_price (true) or added on top (false).
     * This field is ignored if adaptive pricing is not enabled for the business.
     */
    #[Api('adaptive_currency_fees_inclusive', optional: true)]
    public ?bool $adaptiveCurrencyFeesInclusive;

    /**
     * Metadata for the payment. If not passed, the metadata of the subscription will be taken.
     *
     * @var null|array<string, string> $metadata
     */
    #[Api(type: new MapOf('string'), nullable: true, optional: true)]
    public ?array $metadata;

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
     * `new SubscriptionChargeParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionChargeParams::with(productPrice: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionChargeParams)->withProductPrice(...)
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
     * @param null|array<string, string> $metadata
     * @param Currency::* $productCurrency
     */
    public static function with(
        int $productPrice,
        ?bool $adaptiveCurrencyFeesInclusive = null,
        ?array $metadata = null,
        ?string $productCurrency = null,
        ?string $productDescription = null,
    ): self {
        $obj = new self;

        $obj->productPrice = $productPrice;

        null !== $adaptiveCurrencyFeesInclusive && $obj->adaptiveCurrencyFeesInclusive = $adaptiveCurrencyFeesInclusive;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $productCurrency && $obj->productCurrency = $productCurrency;
        null !== $productDescription && $obj->productDescription = $productDescription;

        return $obj;
    }

    /**
     * The product price. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    public function withProductPrice(int $productPrice): self
    {
        $obj = clone $this;
        $obj->productPrice = $productPrice;

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
     * Metadata for the payment. If not passed, the metadata of the subscription will be taken.
     *
     * @param null|array<string, string> $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

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
}
