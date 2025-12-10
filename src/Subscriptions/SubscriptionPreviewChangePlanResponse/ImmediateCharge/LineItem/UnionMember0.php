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
        $self = new self;

        $self['id'] = $id;
        $self['currency'] = $currency;
        $self['productID'] = $productID;
        $self['prorationFactor'] = $prorationFactor;
        $self['quantity'] = $quantity;
        $self['taxInclusive'] = $taxInclusive;
        $self['type'] = $type;
        $self['unitPrice'] = $unitPrice;

        null !== $description && $self['description'] = $description;
        null !== $name && $self['name'] = $name;
        null !== $tax && $self['tax'] = $tax;
        null !== $taxRate && $self['taxRate'] = $taxRate;

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

    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

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

    public function withTaxInclusive(bool $taxInclusive): self
    {
        $self = clone $this;
        $self['taxInclusive'] = $taxInclusive;

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

    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withTax(?int $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }

    public function withTaxRate(?float $taxRate): self
    {
        $self = clone $this;
        $self['taxRate'] = $taxRate;

        return $self;
    }
}
