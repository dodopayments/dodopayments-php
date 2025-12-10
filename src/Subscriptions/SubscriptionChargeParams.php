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
 *   productPrice: int,
 *   adaptiveCurrencyFeesInclusive?: bool|null,
 *   customerBalanceConfig?: null|CustomerBalanceConfig|array{
 *     allowCustomerCreditsPurchase?: bool|null,
 *     allowCustomerCreditsUsage?: bool|null,
 *   },
 *   metadata?: array<string,string>|null,
 *   productCurrency?: null|Currency|value-of<Currency>,
 *   productDescription?: string|null,
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
    #[Required('product_price')]
    public int $productPrice;

    /**
     * Whether adaptive currency fees should be included in the product_price (true) or added on top (false).
     * This field is ignored if adaptive pricing is not enabled for the business.
     */
    #[Optional('adaptive_currency_fees_inclusive', nullable: true)]
    public ?bool $adaptiveCurrencyFeesInclusive;

    /**
     * Specify how customer balance is used for the payment.
     */
    #[Optional('customer_balance_config', nullable: true)]
    public ?CustomerBalanceConfig $customerBalanceConfig;

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
     * @var value-of<Currency>|null $productCurrency
     */
    #[Optional('product_currency', enum: Currency::class, nullable: true)]
    public ?string $productCurrency;

    /**
     * Optional product description override for billing and line items.
     * If not specified, the stored description of the product will be used.
     */
    #[Optional('product_description', nullable: true)]
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
     * @param CustomerBalanceConfig|array{
     *   allowCustomerCreditsPurchase?: bool|null,
     *   allowCustomerCreditsUsage?: bool|null,
     * }|null $customerBalanceConfig
     * @param array<string,string>|null $metadata
     * @param Currency|value-of<Currency>|null $productCurrency
     */
    public static function with(
        int $productPrice,
        ?bool $adaptiveCurrencyFeesInclusive = null,
        CustomerBalanceConfig|array|null $customerBalanceConfig = null,
        ?array $metadata = null,
        Currency|string|null $productCurrency = null,
        ?string $productDescription = null,
    ): self {
        $self = new self;

        $self['productPrice'] = $productPrice;

        null !== $adaptiveCurrencyFeesInclusive && $self['adaptiveCurrencyFeesInclusive'] = $adaptiveCurrencyFeesInclusive;
        null !== $customerBalanceConfig && $self['customerBalanceConfig'] = $customerBalanceConfig;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $productCurrency && $self['productCurrency'] = $productCurrency;
        null !== $productDescription && $self['productDescription'] = $productDescription;

        return $self;
    }

    /**
     * The product price. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     */
    public function withProductPrice(int $productPrice): self
    {
        $self = clone $this;
        $self['productPrice'] = $productPrice;

        return $self;
    }

    /**
     * Whether adaptive currency fees should be included in the product_price (true) or added on top (false).
     * This field is ignored if adaptive pricing is not enabled for the business.
     */
    public function withAdaptiveCurrencyFeesInclusive(
        ?bool $adaptiveCurrencyFeesInclusive
    ): self {
        $self = clone $this;
        $self['adaptiveCurrencyFeesInclusive'] = $adaptiveCurrencyFeesInclusive;

        return $self;
    }

    /**
     * Specify how customer balance is used for the payment.
     *
     * @param CustomerBalanceConfig|array{
     *   allowCustomerCreditsPurchase?: bool|null,
     *   allowCustomerCreditsUsage?: bool|null,
     * }|null $customerBalanceConfig
     */
    public function withCustomerBalanceConfig(
        CustomerBalanceConfig|array|null $customerBalanceConfig
    ): self {
        $self = clone $this;
        $self['customerBalanceConfig'] = $customerBalanceConfig;

        return $self;
    }

    /**
     * Metadata for the payment. If not passed, the metadata of the subscription will be taken.
     *
     * @param array<string,string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Optional currency of the product price. If not specified, defaults to the currency of the product.
     *
     * @param Currency|value-of<Currency>|null $productCurrency
     */
    public function withProductCurrency(
        Currency|string|null $productCurrency
    ): self {
        $self = clone $this;
        $self['productCurrency'] = $productCurrency;

        return $self;
    }

    /**
     * Optional product description override for billing and line items.
     * If not specified, the stored description of the product will be used.
     */
    public function withProductDescription(?string $productDescription): self
    {
        $self = clone $this;
        $self['productDescription'] = $productDescription;

        return $self;
    }
}
