<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem;

use Dodopayments\Core\Attributes\Api;
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
 *   proration_factor: float,
 *   quantity: int,
 *   tax_category: value-of<TaxCategory>,
 *   tax_inclusive: bool,
 *   tax_rate: float,
 *   type: value-of<Type>,
 *   unit_price: int,
 *   description?: string|null,
 *   tax?: int|null,
 * }
 */
final class UnionMember1 implements BaseModel
{
    /** @use SdkModel<UnionMember1Shape> */
    use SdkModel;

    #[Api]
    public string $id;

    /** @var value-of<Currency> $currency */
    #[Api(enum: Currency::class)]
    public string $currency;

    #[Api]
    public string $name;

    #[Api]
    public float $proration_factor;

    #[Api]
    public int $quantity;

    /**
     * Represents the different categories of taxation applicable to various products and services.
     *
     * @var value-of<TaxCategory> $tax_category
     */
    #[Api(enum: TaxCategory::class)]
    public string $tax_category;

    #[Api]
    public bool $tax_inclusive;

    #[Api]
    public float $tax_rate;

    /** @var value-of<Type> $type */
    #[Api(enum: Type::class)]
    public string $type;

    #[Api]
    public int $unit_price;

    #[Api(nullable: true, optional: true)]
    public ?string $description;

    #[Api(nullable: true, optional: true)]
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
     *   proration_factor: ...,
     *   quantity: ...,
     *   tax_category: ...,
     *   tax_inclusive: ...,
     *   tax_rate: ...,
     *   type: ...,
     *   unit_price: ...,
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
     * @param TaxCategory|value-of<TaxCategory> $tax_category
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        Currency|string $currency,
        string $name,
        float $proration_factor,
        int $quantity,
        TaxCategory|string $tax_category,
        bool $tax_inclusive,
        float $tax_rate,
        Type|string $type,
        int $unit_price,
        ?string $description = null,
        ?int $tax = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['currency'] = $currency;
        $obj['name'] = $name;
        $obj['proration_factor'] = $proration_factor;
        $obj['quantity'] = $quantity;
        $obj['tax_category'] = $tax_category;
        $obj['tax_inclusive'] = $tax_inclusive;
        $obj['tax_rate'] = $tax_rate;
        $obj['type'] = $type;
        $obj['unit_price'] = $unit_price;

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
        $obj['proration_factor'] = $prorationFactor;

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
        $obj['tax_category'] = $taxCategory;

        return $obj;
    }

    public function withTaxInclusive(bool $taxInclusive): self
    {
        $obj = clone $this;
        $obj['tax_inclusive'] = $taxInclusive;

        return $obj;
    }

    public function withTaxRate(float $taxRate): self
    {
        $obj = clone $this;
        $obj['tax_rate'] = $taxRate;

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
        $obj['unit_price'] = $unitPrice;

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
