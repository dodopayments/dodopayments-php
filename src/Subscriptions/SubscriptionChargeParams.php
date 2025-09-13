<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Subscriptions\SubscriptionChargeParams\CustomerBalanceConfig;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new SubscriptionChargeParams); // set properties as needed
 * $client->subscriptions->charge(...$params->toArray());
 * ```.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->subscriptions->charge(...$params->toArray());`
 *
 * @see Dodopayments\Subscriptions->charge
 *
 * @phpstan-type subscription_charge_params = array{
 *   productPrice: int,
 *   adaptiveCurrencyFeesInclusive?: bool|null,
 *   customerBalanceConfig?: CustomerBalanceConfig|null,
 *   metadata?: array<string, string>|null,
 *   productCurrency?: null|Currency|value-of<Currency>,
 *   productDescription?: string|null,
 * }
 */
final class SubscriptionChargeParams implements BaseModel
{
    /** @use SdkModel<subscription_charge_params> */
    use SdkModel;
    use SdkParams;

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
    #[Api('adaptive_currency_fees_inclusive', nullable: true, optional: true)]
    public ?bool $adaptiveCurrencyFeesInclusive;

    /**
     * Specify how customer balance is used for the payment.
     */
    #[Api('customer_balance_config', nullable: true, optional: true)]
    public ?CustomerBalanceConfig $customerBalanceConfig;

    /**
     * Metadata for the payment. If not passed, the metadata of the subscription will be taken.
     *
     * @var array<string, string>|null $metadata
     */
    #[Api(map: 'string', nullable: true, optional: true)]
    public ?array $metadata;

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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string, string>|null $metadata
     * @param Currency|value-of<Currency>|null $productCurrency
     */
    public static function with(
        int $productPrice,
        ?bool $adaptiveCurrencyFeesInclusive = null,
        ?CustomerBalanceConfig $customerBalanceConfig = null,
        ?array $metadata = null,
        Currency|string|null $productCurrency = null,
        ?string $productDescription = null,
    ): self {
        $obj = new self;

        $obj->productPrice = $productPrice;

        null !== $adaptiveCurrencyFeesInclusive && $obj->adaptiveCurrencyFeesInclusive = $adaptiveCurrencyFeesInclusive;
        null !== $customerBalanceConfig && $obj->customerBalanceConfig = $customerBalanceConfig;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $productCurrency && $obj->productCurrency = $productCurrency instanceof Currency ? $productCurrency->value : $productCurrency;
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
     * Specify how customer balance is used for the payment.
     */
    public function withCustomerBalanceConfig(
        ?CustomerBalanceConfig $customerBalanceConfig
    ): self {
        $obj = clone $this;
        $obj->customerBalanceConfig = $customerBalanceConfig;

        return $obj;
    }

    /**
     * Metadata for the payment. If not passed, the metadata of the subscription will be taken.
     *
     * @param array<string, string>|null $metadata
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
}
