<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Subscriptions\SubscriptionChargeParams\CustomerBalanceConfig;

/**
 * @see Dodopayments\Services\SubscriptionsService::charge()
 *
 * @phpstan-type SubscriptionChargeParamsShape = array{
 *   product_price: int,
 *   adaptive_currency_fees_inclusive?: bool|null,
 *   customer_balance_config?: null|CustomerBalanceConfig|array{
 *     allow_customer_credits_purchase?: bool|null,
 *     allow_customer_credits_usage?: bool|null,
 *   },
 *   metadata?: array<string,string>|null,
 *   product_currency?: null|Currency|value-of<Currency>,
 *   product_description?: string|null,
 * }
 */
final class SubscriptionChargeParams implements BaseModel
{
    /** @use SdkModel<SubscriptionChargeParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The product price. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    #[Required]
    public int $product_price;

    /**
     * Whether adaptive currency fees should be included in the product_price (true) or added on top (false).
     * This field is ignored if adaptive pricing is not enabled for the business.
     */
    #[Optional(nullable: true)]
    public ?bool $adaptive_currency_fees_inclusive;

    /**
     * Specify how customer balance is used for the payment.
     */
    #[Optional(nullable: true)]
    public ?CustomerBalanceConfig $customer_balance_config;

    /**
     * Metadata for the payment. If not passed, the metadata of the subscription will be taken.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string', nullable: true)]
    public ?array $metadata;

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
     * `new SubscriptionChargeParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionChargeParams::with(product_price: ...)
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
     * @param CustomerBalanceConfig|array{
     *   allow_customer_credits_purchase?: bool|null,
     *   allow_customer_credits_usage?: bool|null,
     * }|null $customer_balance_config
     * @param array<string,string>|null $metadata
     * @param Currency|value-of<Currency>|null $product_currency
     */
    public static function with(
        int $product_price,
        ?bool $adaptive_currency_fees_inclusive = null,
        CustomerBalanceConfig|array|null $customer_balance_config = null,
        ?array $metadata = null,
        Currency|string|null $product_currency = null,
        ?string $product_description = null,
    ): self {
        $obj = new self;

        $obj['product_price'] = $product_price;

        null !== $adaptive_currency_fees_inclusive && $obj['adaptive_currency_fees_inclusive'] = $adaptive_currency_fees_inclusive;
        null !== $customer_balance_config && $obj['customer_balance_config'] = $customer_balance_config;
        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $product_currency && $obj['product_currency'] = $product_currency;
        null !== $product_description && $obj['product_description'] = $product_description;

        return $obj;
    }

    /**
     * The product price. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    public function withProductPrice(int $productPrice): self
    {
        $obj = clone $this;
        $obj['product_price'] = $productPrice;

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
     * Specify how customer balance is used for the payment.
     *
     * @param CustomerBalanceConfig|array{
     *   allow_customer_credits_purchase?: bool|null,
     *   allow_customer_credits_usage?: bool|null,
     * }|null $customerBalanceConfig
     */
    public function withCustomerBalanceConfig(
        CustomerBalanceConfig|array|null $customerBalanceConfig
    ): self {
        $obj = clone $this;
        $obj['customer_balance_config'] = $customerBalanceConfig;

        return $obj;
    }

    /**
     * Metadata for the payment. If not passed, the metadata of the subscription will be taken.
     *
     * @param array<string,string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

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
}
