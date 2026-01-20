<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse\ProductCart;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;

/**
 * @phpstan-type AddonShape = array{
 *   addonID: string,
 *   currency: Currency|value-of<Currency>,
 *   discountedPrice: int,
 *   name: string,
 *   ogCurrency: Currency|value-of<Currency>,
 *   ogPrice: int,
 *   quantity: int,
 *   taxCategory: TaxCategory|value-of<TaxCategory>,
 *   taxInclusive: bool,
 *   taxRate: int,
 *   description?: string|null,
 *   discountAmount?: int|null,
 *   tax?: int|null,
 * }
 */
final class Addon implements BaseModel
{
    /** @use SdkModel<AddonShape> */
    use SdkModel;

    #[Required('addon_id')]
    public string $addonID;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required('discounted_price')]
    public int $discountedPrice;

    #[Required]
    public string $name;

    /** @var value-of<Currency> $ogCurrency */
    #[Required('og_currency', enum: Currency::class)]
    public string $ogCurrency;

    #[Required('og_price')]
    public int $ogPrice;

    #[Required]
    public int $quantity;

    /**
     * Represents the different categories of taxation applicable to various products and services.
     *
     * @var value-of<TaxCategory> $taxCategory
     */
    #[Required('tax_category', enum: TaxCategory::class)]
    public string $taxCategory;

    #[Required('tax_inclusive')]
    public bool $taxInclusive;

    #[Required('tax_rate')]
    public int $taxRate;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional('discount_amount', nullable: true)]
    public ?int $discountAmount;

    #[Optional(nullable: true)]
    public ?int $tax;

    /**
     * `new Addon()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Addon::with(
     *   addonID: ...,
     *   currency: ...,
     *   discountedPrice: ...,
     *   name: ...,
     *   ogCurrency: ...,
     *   ogPrice: ...,
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
     * (new Addon)
     *   ->withAddonID(...)
     *   ->withCurrency(...)
     *   ->withDiscountedPrice(...)
     *   ->withName(...)
     *   ->withOgCurrency(...)
     *   ->withOgPrice(...)
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
     * @param Currency|value-of<Currency> $ogCurrency
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     */
    public static function with(
        string $addonID,
        Currency|string $currency,
        int $discountedPrice,
        string $name,
        Currency|string $ogCurrency,
        int $ogPrice,
        int $quantity,
        TaxCategory|string $taxCategory,
        bool $taxInclusive,
        int $taxRate,
        ?string $description = null,
        ?int $discountAmount = null,
        ?int $tax = null,
    ): self {
        $self = new self;

        $self['addonID'] = $addonID;
        $self['currency'] = $currency;
        $self['discountedPrice'] = $discountedPrice;
        $self['name'] = $name;
        $self['ogCurrency'] = $ogCurrency;
        $self['ogPrice'] = $ogPrice;
        $self['quantity'] = $quantity;
        $self['taxCategory'] = $taxCategory;
        $self['taxInclusive'] = $taxInclusive;
        $self['taxRate'] = $taxRate;

        null !== $description && $self['description'] = $description;
        null !== $discountAmount && $self['discountAmount'] = $discountAmount;
        null !== $tax && $self['tax'] = $tax;

        return $self;
    }

    public function withAddonID(string $addonID): self
    {
        $self = clone $this;
        $self['addonID'] = $addonID;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withDiscountedPrice(int $discountedPrice): self
    {
        $self = clone $this;
        $self['discountedPrice'] = $discountedPrice;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency> $ogCurrency
     */
    public function withOgCurrency(Currency|string $ogCurrency): self
    {
        $self = clone $this;
        $self['ogCurrency'] = $ogCurrency;

        return $self;
    }

    public function withOgPrice(int $ogPrice): self
    {
        $self = clone $this;
        $self['ogPrice'] = $ogPrice;

        return $self;
    }

    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * Represents the different categories of taxation applicable to various products and services.
     *
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     */
    public function withTaxCategory(TaxCategory|string $taxCategory): self
    {
        $self = clone $this;
        $self['taxCategory'] = $taxCategory;

        return $self;
    }

    public function withTaxInclusive(bool $taxInclusive): self
    {
        $self = clone $this;
        $self['taxInclusive'] = $taxInclusive;

        return $self;
    }

    public function withTaxRate(int $taxRate): self
    {
        $self = clone $this;
        $self['taxRate'] = $taxRate;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withDiscountAmount(?int $discountAmount): self
    {
        $self = clone $this;
        $self['discountAmount'] = $discountAmount;

        return $self;
    }

    public function withTax(?int $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }
}
