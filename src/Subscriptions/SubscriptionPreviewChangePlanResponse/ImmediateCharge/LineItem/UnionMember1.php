<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\UnionMember1\Type;

/**
 * @phpstan-type UnionMember1Shape = array{
 *   id: string,
 *   currency: value-of<Currency>,
 *   name: string,
 *   prorationFactor: float,
 *   quantity: int,
 *   taxCategory: value-of<TaxCategory>,
 *   taxInclusive: bool,
 *   taxRate: float,
 *   type: value-of<Type>,
 *   unitPrice: int,
 *   description?: string|null,
 *   tax?: int|null,
 * }
 */
final class UnionMember1 implements BaseModel
{
    /** @use SdkModel<UnionMember1Shape> */
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
     * `new UnionMember1()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember1::with(
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
     * (new UnionMember1)
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
        $obj = new self;

        $obj['id'] = $id;
        $obj['currency'] = $currency;
        $obj['name'] = $name;
        $obj['prorationFactor'] = $prorationFactor;
        $obj['quantity'] = $quantity;
        $obj['taxCategory'] = $taxCategory;
        $obj['taxInclusive'] = $taxInclusive;
        $obj['taxRate'] = $taxRate;
        $obj['type'] = $type;
        $obj['unitPrice'] = $unitPrice;

        null !== $description && $obj['description'] = $description;
        null !== $tax && $obj['tax'] = $tax;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    public function withProrationFactor(float $prorationFactor): self
    {
        $obj = clone $this;
        $obj['prorationFactor'] = $prorationFactor;

        return $obj;
    }

    public function withQuantity(int $quantity): self
    {
        $obj = clone $this;
        $obj['quantity'] = $quantity;

        return $obj;
    }

    /**
     * Represents the different categories of taxation applicable to various products and services.
     *
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     */
    public function withTaxCategory(TaxCategory|string $taxCategory): self
    {
        $obj = clone $this;
        $obj['taxCategory'] = $taxCategory;

        return $obj;
    }

    public function withTaxInclusive(bool $taxInclusive): self
    {
        $obj = clone $this;
        $obj['taxInclusive'] = $taxInclusive;

        return $obj;
    }

    public function withTaxRate(float $taxRate): self
    {
        $obj = clone $this;
        $obj['taxRate'] = $taxRate;

        return $obj;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }

    public function withUnitPrice(int $unitPrice): self
    {
        $obj = clone $this;
        $obj['unitPrice'] = $unitPrice;

        return $obj;
    }

    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    public function withTax(?int $tax): self
    {
        $obj = clone $this;
        $obj['tax'] = $tax;

        return $obj;
    }
}
