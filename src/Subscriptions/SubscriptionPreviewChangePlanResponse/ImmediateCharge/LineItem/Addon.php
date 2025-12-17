<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\Addon\Type;

/**
 * @phpstan-type AddonShape = array{
 *   id: string,
 *   currency: Currency|value-of<Currency>,
 *   name: string,
 *   prorationFactor: float,
 *   quantity: int,
 *   taxCategory: TaxCategory|value-of<TaxCategory>,
 *   taxInclusive: bool,
 *   taxRate: float,
 *   type: Type|value-of<Type>,
 *   unitPrice: int,
 *   description?: string|null,
 *   tax?: int|null,
 * }
 */
final class Addon implements BaseModel
{
    /** @use SdkModel<AddonShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required]
    public string $name;

    #[Required('proration_factor')]
    public float $prorationFactor;

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
    public float $taxRate;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Required('unit_price')]
    public int $unitPrice;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional(nullable: true)]
    public ?int $tax;

    /**
     * `new Addon()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Addon::with(
     *   id: ...,
     *   currency: ...,
     *   name: ...,
     *   prorationFactor: ...,
     *   quantity: ...,
     *   taxCategory: ...,
     *   taxInclusive: ...,
     *   taxRate: ...,
     *   type: ...,
     *   unitPrice: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Addon)
     *   ->withID(...)
     *   ->withCurrency(...)
     *   ->withName(...)
     *   ->withProrationFactor(...)
     *   ->withQuantity(...)
     *   ->withTaxCategory(...)
     *   ->withTaxInclusive(...)
     *   ->withTaxRate(...)
     *   ->withType(...)
     *   ->withUnitPrice(...)
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
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        Currency|string $currency,
        string $name,
        float $prorationFactor,
        int $quantity,
        TaxCategory|string $taxCategory,
        bool $taxInclusive,
        float $taxRate,
        Type|string $type,
        int $unitPrice,
        ?string $description = null,
        ?int $tax = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['currency'] = $currency;
        $self['name'] = $name;
        $self['prorationFactor'] = $prorationFactor;
        $self['quantity'] = $quantity;
        $self['taxCategory'] = $taxCategory;
        $self['taxInclusive'] = $taxInclusive;
        $self['taxRate'] = $taxRate;
        $self['type'] = $type;
        $self['unitPrice'] = $unitPrice;

        null !== $description && $self['description'] = $description;
        null !== $tax && $self['tax'] = $tax;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withProrationFactor(float $prorationFactor): self
    {
        $self = clone $this;
        $self['prorationFactor'] = $prorationFactor;

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

    public function withTaxRate(float $taxRate): self
    {
        $self = clone $this;
        $self['taxRate'] = $taxRate;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withUnitPrice(int $unitPrice): self
    {
        $self = clone $this;
        $self['unitPrice'] = $unitPrice;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withTax(?int $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }
}
