<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Invoices\InvoiceLine\Kind;

/**
 * One frozen line. Amounts are in the smallest currency unit.
 *
 * @phpstan-type InvoiceLineShape = array{
 *   amount: int,
 *   kind: Kind|value-of<Kind>,
 *   quantity: int,
 *   tax: int,
 *   taxInclusive: bool,
 *   unitAmount: int,
 *   addonID?: string|null,
 *   description?: string|null,
 *   name?: string|null,
 *   periodEnd?: \DateTimeInterface|null,
 *   periodStart?: \DateTimeInterface|null,
 *   productID?: string|null,
 *   subscriptionID?: string|null,
 *   taxRate?: int|null,
 * }
 */
final class InvoiceLine implements BaseModel
{
    /** @use SdkModel<InvoiceLineShape> */
    use SdkModel;

    #[Required]
    public int $amount;

    /** @var value-of<Kind> $kind */
    #[Required(enum: Kind::class)]
    public string $kind;

    /**
     * A usage line has a quantity of 1. Its amount is the full usage charge.
     */
    #[Required]
    public int $quantity;

    #[Required]
    public int $tax;

    /**
     * `true` when `amount` includes `tax`.
     */
    #[Required('tax_inclusive')]
    public bool $taxInclusive;

    #[Required('unit_amount')]
    public int $unitAmount;

    #[Optional('addon_id', nullable: true)]
    public ?string $addonID;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional(nullable: true)]
    public ?string $name;

    #[Optional('period_end', nullable: true)]
    public ?\DateTimeInterface $periodEnd;

    #[Optional('period_start', nullable: true)]
    public ?\DateTimeInterface $periodStart;

    #[Optional('product_id', nullable: true)]
    public ?string $productID;

    #[Optional('subscription_id', nullable: true)]
    public ?string $subscriptionID;

    /**
     * Tax percent times 100. For example, 1800 is 18%.
     */
    #[Optional('tax_rate', nullable: true)]
    public ?int $taxRate;

    /**
     * `new InvoiceLine()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceLine::with(
     *   amount: ...,
     *   kind: ...,
     *   quantity: ...,
     *   tax: ...,
     *   taxInclusive: ...,
     *   unitAmount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceLine)
     *   ->withAmount(...)
     *   ->withKind(...)
     *   ->withQuantity(...)
     *   ->withTax(...)
     *   ->withTaxInclusive(...)
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
     * @param Kind|value-of<Kind> $kind
     */
    public static function with(
        int $amount,
        Kind|string $kind,
        int $quantity,
        int $tax,
        bool $taxInclusive,
        int $unitAmount,
        ?string $addonID = null,
        ?string $description = null,
        ?string $name = null,
        ?\DateTimeInterface $periodEnd = null,
        ?\DateTimeInterface $periodStart = null,
        ?string $productID = null,
        ?string $subscriptionID = null,
        ?int $taxRate = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['kind'] = $kind;
        $self['quantity'] = $quantity;
        $self['tax'] = $tax;
        $self['taxInclusive'] = $taxInclusive;
        $self['unitAmount'] = $unitAmount;

        null !== $addonID && $self['addonID'] = $addonID;
        null !== $description && $self['description'] = $description;
        null !== $name && $self['name'] = $name;
        null !== $periodEnd && $self['periodEnd'] = $periodEnd;
        null !== $periodStart && $self['periodStart'] = $periodStart;
        null !== $productID && $self['productID'] = $productID;
        null !== $subscriptionID && $self['subscriptionID'] = $subscriptionID;
        null !== $taxRate && $self['taxRate'] = $taxRate;

        return $self;
    }

    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * @param Kind|value-of<Kind> $kind
     */
    public function withKind(Kind|string $kind): self
    {
        $self = clone $this;
        $self['kind'] = $kind;

        return $self;
    }

    /**
     * A usage line has a quantity of 1. Its amount is the full usage charge.
     */
    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    public function withTax(int $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }

    /**
     * `true` when `amount` includes `tax`.
     */
    public function withTaxInclusive(bool $taxInclusive): self
    {
        $self = clone $this;
        $self['taxInclusive'] = $taxInclusive;

        return $self;
    }

    public function withUnitAmount(int $unitAmount): self
    {
        $self = clone $this;
        $self['unitAmount'] = $unitAmount;

        return $self;
    }

    public function withAddonID(?string $addonID): self
    {
        $self = clone $this;
        $self['addonID'] = $addonID;

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

    public function withPeriodEnd(?\DateTimeInterface $periodEnd): self
    {
        $self = clone $this;
        $self['periodEnd'] = $periodEnd;

        return $self;
    }

    public function withPeriodStart(?\DateTimeInterface $periodStart): self
    {
        $self = clone $this;
        $self['periodStart'] = $periodStart;

        return $self;
    }

    public function withProductID(?string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    public function withSubscriptionID(?string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    /**
     * Tax percent times 100. For example, 1800 is 18%.
     */
    public function withTaxRate(?int $taxRate): self
    {
        $self = clone $this;
        $self['taxRate'] = $taxRate;

        return $self;
    }
}
