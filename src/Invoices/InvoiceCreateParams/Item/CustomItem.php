<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\InvoiceCreateParams\Item;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\TaxCategory;

/**
 * A line that exists only on this invoice.
 *
 * @phpstan-type CustomItemShape = array{
 *   description: string,
 *   kind: 'custom',
 *   taxCategory: TaxCategory|value-of<TaxCategory>,
 *   unitAmount: int,
 *   quantity?: int|null,
 * }
 */
final class CustomItem implements BaseModel
{
    /** @use SdkModel<CustomItemShape> */
    use SdkModel;

    /** @var 'custom' $kind */
    #[Required]
    public string $kind = 'custom';

    #[Required]
    public string $description;

    /**
     * Represents the different categories of taxation applicable to various products and services.
     *
     * @var value-of<TaxCategory> $taxCategory
     */
    #[Required('tax_category', enum: TaxCategory::class)]
    public string $taxCategory;

    /**
     * The price in the smallest currency unit.
     */
    #[Required('unit_amount')]
    public int $unitAmount;

    /**
     * The default is 1.
     */
    #[Optional(nullable: true)]
    public ?int $quantity;

    /**
     * `new CustomItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomItem::with(description: ..., taxCategory: ..., unitAmount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomItem)
     *   ->withDescription(...)
     *   ->withTaxCategory(...)
     *   ->withUnitAmount(...)
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
     * @param TaxCategory|value-of<TaxCategory> $taxCategory
     */
    public static function with(
        string $description,
        TaxCategory|string $taxCategory,
        int $unitAmount,
        ?int $quantity = null,
    ): self {
        $self = new self;

        $self['description'] = $description;
        $self['taxCategory'] = $taxCategory;
        $self['unitAmount'] = $unitAmount;

        null !== $quantity && $self['quantity'] = $quantity;

        return $self;
    }

    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * @param 'custom' $kind
     */
    public function withKind(string $kind): self
    {
        $self = clone $this;
        $self['kind'] = $kind;

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

    /**
     * The price in the smallest currency unit.
     */
    public function withUnitAmount(int $unitAmount): self
    {
        $self = clone $this;
        $self['unitAmount'] = $unitAmount;

        return $self;
    }

    /**
     * The default is 1.
     */
    public function withQuantity(?int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }
}
