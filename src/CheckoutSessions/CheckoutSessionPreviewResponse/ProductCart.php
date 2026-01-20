<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse;

use Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse\ProductCart\Addon;
use Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse\ProductCart\Meter;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;

/**
 * @phpstan-import-type MeterShape from \Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse\ProductCart\Meter
 * @phpstan-import-type AddonShape from \Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse\ProductCart\Addon
 *
 * @phpstan-type ProductCartShape = array{
 *   currency: Currency|value-of<Currency>,
 *   discountedPrice: int,
 *   isSubscription: bool,
 *   isUsageBased: bool,
 *   meters: list<Meter|MeterShape>,
 *   ogCurrency: Currency|value-of<Currency>,
 *   ogPrice: int,
 *   productID: string,
 *   quantity: int,
 *   taxCategory: TaxCategory|value-of<TaxCategory>,
 *   taxInclusive: bool,
 *   taxRate: int,
 *   addons?: list<Addon|AddonShape>|null,
 *   description?: string|null,
 *   discountAmount?: int|null,
 *   discountCycle?: int|null,
 *   name?: string|null,
 *   tax?: int|null,
 * }
 */
final class ProductCart implements BaseModel
{
    /** @use SdkModel<ProductCartShape> */
    use SdkModel;

    /**
     * the currency in which the calculatiosn were made.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * discounted price.
     */
    #[Required('discounted_price')]
    public int $discountedPrice;

    /**
     * Whether this is a subscription product (affects tax calculation in breakup).
     */
    #[Required('is_subscription')]
    public bool $isSubscription;

    #[Required('is_usage_based')]
    public bool $isUsageBased;

    /** @var list<Meter> $meters */
    #[Required(list: Meter::class)]
    public array $meters;

    /**
     * the product currency.
     *
     * @var value-of<Currency> $ogCurrency
     */
    #[Required('og_currency', enum: Currency::class)]
    public string $ogCurrency;

    /**
     * original price of the product.
     */
    #[Required('og_price')]
    public int $ogPrice;

    /**
     * unique id of the product.
     */
    #[Required('product_id')]
    public string $productID;

    /**
     * Quanitity.
     */
    #[Required]
    public int $quantity;

    /**
     * tax category.
     *
     * @var value-of<TaxCategory> $taxCategory
     */
    #[Required('tax_category', enum: TaxCategory::class)]
    public string $taxCategory;

    /**
     * Whether tax is included in the price.
     */
    #[Required('tax_inclusive')]
    public bool $taxInclusive;

    /**
     * tax rate.
     */
    #[Required('tax_rate')]
    public int $taxRate;

    /** @var list<Addon>|null $addons */
    #[Optional(list: Addon::class, nullable: true)]
    public ?array $addons;

    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * discount percentage.
     */
    #[Optional('discount_amount', nullable: true)]
    public ?int $discountAmount;

    /**
     * number of cycles the discount will apply.
     */
    #[Optional('discount_cycle', nullable: true)]
    public ?int $discountCycle;

    /**
     * name of the product.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * total tax.
     */
    #[Optional(nullable: true)]
    public ?int $tax;

    /**
     * `new ProductCart()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductCart::with(
     *   currency: ...,
     *   discountedPrice: ...,
     *   isSubscription: ...,
     *   isUsageBased: ...,
     *   meters: ...,
     *   ogCurrency: ...,
     *   ogPrice: ...,
     *   productID: ...,
     *   quantity: ...,
     *   taxCategory: ...,
     *   taxInclusive: ...,
     *   taxRate: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductCart)
     *   ->withCurrency(...)
     *   ->withDiscountedPrice(...)
     *   ->withIsSubscription(...)
     *   ->withIsUsageBased(...)
     *   ->withMeters(...)
     *   ->withOgCurrency(...)
     *   ->withOgPrice(...)
     *   ->withProductID(...)
     *   ->withQuantity(...)
     *   ->withTaxCategory(...)
     *   ->withTaxInclusive(...)
     *   ->withTaxRate(...)
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
     * @param Currency|value-of<Currency> $currency
     * @param list<Meter|MeterShape> $meters
     * @param Currency|value-of<Currency> $ogCurrency
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     * @param list<Addon|AddonShape>|null $addons
     */
    public static function with(
        Currency|string $currency,
        int $discountedPrice,
        bool $isSubscription,
        bool $isUsageBased,
        array $meters,
        Currency|string $ogCurrency,
        int $ogPrice,
        string $productID,
        int $quantity,
        TaxCategory|string $taxCategory,
        bool $taxInclusive,
        int $taxRate,
        ?array $addons = null,
        ?string $description = null,
        ?int $discountAmount = null,
        ?int $discountCycle = null,
        ?string $name = null,
        ?int $tax = null,
    ): self {
        $self = new self;

        $self['currency'] = $currency;
        $self['discountedPrice'] = $discountedPrice;
        $self['isSubscription'] = $isSubscription;
        $self['isUsageBased'] = $isUsageBased;
        $self['meters'] = $meters;
        $self['ogCurrency'] = $ogCurrency;
        $self['ogPrice'] = $ogPrice;
        $self['productID'] = $productID;
        $self['quantity'] = $quantity;
        $self['taxCategory'] = $taxCategory;
        $self['taxInclusive'] = $taxInclusive;
        $self['taxRate'] = $taxRate;

        null !== $addons && $self['addons'] = $addons;
        null !== $description && $self['description'] = $description;
        null !== $discountAmount && $self['discountAmount'] = $discountAmount;
        null !== $discountCycle && $self['discountCycle'] = $discountCycle;
        null !== $name && $self['name'] = $name;
        null !== $tax && $self['tax'] = $tax;

        return $self;
    }

    /**
     * the currency in which the calculatiosn were made.
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
     * discounted price.
     */
    public function withDiscountedPrice(int $discountedPrice): self
    {
        $self = clone $this;
        $self['discountedPrice'] = $discountedPrice;

        return $self;
    }

    /**
     * Whether this is a subscription product (affects tax calculation in breakup).
     */
    public function withIsSubscription(bool $isSubscription): self
    {
        $self = clone $this;
        $self['isSubscription'] = $isSubscription;

        return $self;
    }

    public function withIsUsageBased(bool $isUsageBased): self
    {
        $self = clone $this;
        $self['isUsageBased'] = $isUsageBased;

        return $self;
    }

    /**
     * @param list<Meter|MeterShape> $meters
     */
    public function withMeters(array $meters): self
    {
        $self = clone $this;
        $self['meters'] = $meters;

        return $self;
    }

    /**
     * the product currency.
     *
     * @param Currency|value-of<Currency> $ogCurrency
     */
    public function withOgCurrency(Currency|string $ogCurrency): self
    {
        $self = clone $this;
        $self['ogCurrency'] = $ogCurrency;

        return $self;
    }

    /**
     * original price of the product.
     */
    public function withOgPrice(int $ogPrice): self
    {
        $self = clone $this;
        $self['ogPrice'] = $ogPrice;

        return $self;
    }

    /**
     * unique id of the product.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * Quanitity.
     */
    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * tax category.
     *
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     */
    public function withTaxCategory(TaxCategory|string $taxCategory): self
    {
        $self = clone $this;
        $self['taxCategory'] = $taxCategory;

        return $self;
    }

    /**
     * Whether tax is included in the price.
     */
    public function withTaxInclusive(bool $taxInclusive): self
    {
        $self = clone $this;
        $self['taxInclusive'] = $taxInclusive;

        return $self;
    }

    /**
     * tax rate.
     */
    public function withTaxRate(int $taxRate): self
    {
        $self = clone $this;
        $self['taxRate'] = $taxRate;

        return $self;
    }

    /**
     * @param list<Addon|AddonShape>|null $addons
     */
    public function withAddons(?array $addons): self
    {
        $self = clone $this;
        $self['addons'] = $addons;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * discount percentage.
     */
    public function withDiscountAmount(?int $discountAmount): self
    {
        $self = clone $this;
        $self['discountAmount'] = $discountAmount;

        return $self;
    }

    /**
     * number of cycles the discount will apply.
     */
    public function withDiscountCycle(?int $discountCycle): self
    {
        $self = clone $this;
        $self['discountCycle'] = $discountCycle;

        return $self;
    }

    /**
     * name of the product.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * total tax.
     */
    public function withTax(?int $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }
}
