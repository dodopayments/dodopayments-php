<?php

declare(strict_types=1);

namespace DodoPayments\Subscriptions;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Core\Conversion\MapOf;
use DodoPayments\Misc\Currency;

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
    public static function from(
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
    public function setProductPrice(int $productPrice): self
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    /**
     * Whether adaptive currency fees should be included in the product_price (true) or added on top (false).
     * This field is ignored if adaptive pricing is not enabled for the business.
     */
    public function setAdaptiveCurrencyFeesInclusive(
        ?bool $adaptiveCurrencyFeesInclusive
    ): self {
        $this->adaptiveCurrencyFeesInclusive = $adaptiveCurrencyFeesInclusive;

        return $this;
    }

    /**
     * Metadata for the payment. If not passed, the metadata of the subscription will be taken.
     *
     * @param null|array<string, string> $metadata
     */
    public function setMetadata(?array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Optional currency of the product price. If not specified, defaults to the currency of the product.
     *
     * @param Currency::* $productCurrency
     */
    public function setProductCurrency(string $productCurrency): self
    {
        $this->productCurrency = $productCurrency;

        return $this;
    }

    /**
     * Optional product description override for billing and line items.
     * If not specified, the stored description of the product will be used.
     */
    public function setProductDescription(?string $productDescription): self
    {
        $this->productDescription = $productDescription;

        return $this;
    }
}
