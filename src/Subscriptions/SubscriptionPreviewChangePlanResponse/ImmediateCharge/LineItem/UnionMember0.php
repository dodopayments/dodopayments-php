<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\UnionMember0\Type;

/**
 * @phpstan-type UnionMember0Shape = array{
 *   id: string,
 *   currency: value-of<Currency>,
 *   productID: string,
 *   prorationFactor: float,
 *   quantity: int,
 *   taxInclusive: bool,
 *   type: value-of<Type>,
 *   unitPrice: int,
 *   description?: string|null,
 *   name?: string|null,
 *   tax?: int|null,
 *   taxRate?: float|null,
 * }
 */
final class UnionMember0 implements BaseModel
{
    /** @use SdkModel<UnionMember0Shape> */
    use SdkModel;

    #[Required]
    public string $id;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required('product_id')]
    public string $productID;

    #[Required('proration_factor')]
    public float $prorationFactor;

    #[Required]
    public int $quantity;

    #[Required('tax_inclusive')]
    public bool $taxInclusive;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Required('unit_price')]
    public int $unitPrice;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional(nullable: true)]
    public ?string $name;

    #[Optional(nullable: true)]
    public ?int $tax;

    #[Optional('tax_rate', nullable: true)]
    public ?float $taxRate;

    /**
     * `new UnionMember0()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember0::with(
     *   id: ...,
     *   currency: ...,
     *   productID: ...,
     *   prorationFactor: ...,
     *   quantity: ...,
     *   taxInclusive: ...,
     *   type: ...,
     *   unitPrice: ...,
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
        string $productID,
        float $prorationFactor,
        int $quantity,
        bool $taxInclusive,
        Type|string $type,
        int $unitPrice,
        ?string $description = null,
        ?string $name = null,
        ?int $tax = null,
        ?float $taxRate = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['currency'] = $currency;
        $obj['productID'] = $productID;
        $obj['prorationFactor'] = $prorationFactor;
        $obj['quantity'] = $quantity;
        $obj['taxInclusive'] = $taxInclusive;
        $obj['type'] = $type;
        $obj['unitPrice'] = $unitPrice;

        null !== $description && $obj['description'] = $description;
        null !== $name && $obj['name'] = $name;
        null !== $tax && $obj['tax'] = $tax;
        null !== $taxRate && $obj['taxRate'] = $taxRate;

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
        $obj['productID'] = $productID;

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

    public function withTaxInclusive(bool $taxInclusive): self
    {
        $obj = clone $this;
        $obj['taxInclusive'] = $taxInclusive;

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
        $obj['taxRate'] = $taxRate;

        return $obj;
    }
}
