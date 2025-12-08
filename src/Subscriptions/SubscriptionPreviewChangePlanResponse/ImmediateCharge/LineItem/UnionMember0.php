<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\UnionMember0\Type;

/**
 * @phpstan-type UnionMember0Shape = array{
 *   id: string,
 *   currency: value-of<Currency>,
 *   product_id: string,
 *   proration_factor: float,
 *   quantity: int,
 *   tax_inclusive: bool,
 *   type: value-of<Type>,
 *   unit_price: int,
 *   description?: string|null,
 *   name?: string|null,
 *   tax?: int|null,
 *   tax_rate?: float|null,
 * }
 */
final class UnionMember0 implements BaseModel
{
    /** @use SdkModel<UnionMember0Shape> */
    use SdkModel;

    #[Api]
    public string $id;

    /** @var value-of<Currency> $currency */
    #[Api(enum: Currency::class)]
    public string $currency;

    #[Api]
    public string $product_id;

    #[Api]
    public float $proration_factor;

    #[Api]
    public int $quantity;

    #[Api]
    public bool $tax_inclusive;

    /** @var value-of<Type> $type */
    #[Api(enum: Type::class)]
    public string $type;

    #[Api]
    public int $unit_price;

    #[Api(nullable: true, optional: true)]
    public ?string $description;

    #[Api(nullable: true, optional: true)]
    public ?string $name;

    #[Api(nullable: true, optional: true)]
    public ?int $tax;

    #[Api(nullable: true, optional: true)]
    public ?float $tax_rate;

    /**
     * `new UnionMember0()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember0::with(
     *   id: ...,
     *   currency: ...,
     *   product_id: ...,
     *   proration_factor: ...,
     *   quantity: ...,
     *   tax_inclusive: ...,
     *   type: ...,
     *   unit_price: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember0)
     *   ->withID(...)
     *   ->withCurrency(...)
     *   ->withProductID(...)
     *   ->withProrationFactor(...)
     *   ->withQuantity(...)
     *   ->withTaxInclusive(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        Currency|string $currency,
        string $product_id,
        float $proration_factor,
        int $quantity,
        bool $tax_inclusive,
        Type|string $type,
        int $unit_price,
        ?string $description = null,
        ?string $name = null,
        ?int $tax = null,
        ?float $tax_rate = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['currency'] = $currency;
        $obj['product_id'] = $product_id;
        $obj['proration_factor'] = $proration_factor;
        $obj['quantity'] = $quantity;
        $obj['tax_inclusive'] = $tax_inclusive;
        $obj['type'] = $type;
        $obj['unit_price'] = $unit_price;

        null !== $description && $obj['description'] = $description;
        null !== $name && $obj['name'] = $name;
        null !== $tax && $obj['tax'] = $tax;
        null !== $tax_rate && $obj['tax_rate'] = $tax_rate;

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

    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj['product_id'] = $productID;

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

    public function withTaxInclusive(bool $taxInclusive): self
    {
        $obj = clone $this;
        $obj['tax_inclusive'] = $taxInclusive;

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

    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    public function withTax(?int $tax): self
    {
        $obj = clone $this;
        $obj['tax'] = $tax;

        return $obj;
    }

    public function withTaxRate(?float $taxRate): self
    {
        $obj = clone $this;
        $obj['tax_rate'] = $taxRate;

        return $obj;
    }
}
