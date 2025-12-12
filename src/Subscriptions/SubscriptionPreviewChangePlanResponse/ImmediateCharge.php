<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\Addon;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\Meter;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\Subscription;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\Subscription\Type;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\Summary;

/**
 * @phpstan-type ImmediateChargeShape = array{
 *   lineItems: list<Subscription|Addon|Meter>, summary: Summary
 * }
 */
final class ImmediateCharge implements BaseModel
{
    /** @use SdkModel<ImmediateChargeShape> */
    use SdkModel;

    /** @var list<Subscription|Addon|Meter> $lineItems */
    #[Required('line_items', list: LineItem::class)]
    public array $lineItems;

    #[Required]
    public Summary $summary;

    /**
     * `new ImmediateCharge()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ImmediateCharge::with(lineItems: ..., summary: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ImmediateCharge)->withLineItems(...)->withSummary(...)
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
     * @param list<Subscription|array{
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
     * }|Addon|array{
     *   id: string,
     *   currency: value-of<Currency>,
     *   name: string,
     *   prorationFactor: float,
     *   quantity: int,
     *   taxCategory: value-of<TaxCategory>,
     *   taxInclusive: bool,
     *   taxRate: float,
     *   type: value-of<Addon\Type>,
     *   unitPrice: int,
     *   description?: string|null,
     *   tax?: int|null,
     * }|Meter|array{
     *   id: string,
     *   chargeableUnits: string,
     *   currency: value-of<Currency>,
     *   freeThreshold: int,
     *   name: string,
     *   pricePerUnit: string,
     *   subtotal: int,
     *   taxInclusive: bool,
     *   taxRate: float,
     *   type: value-of<Meter\Type>,
     *   unitsConsumed: string,
     *   description?: string|null,
     *   tax?: int|null,
     * }> $lineItems
     * @param Summary|array{
     *   currency: value-of<Currency>,
     *   customerCredits: int,
     *   settlementAmount: int,
     *   settlementCurrency: value-of<Currency>,
     *   totalAmount: int,
     *   settlementTax?: int|null,
     *   tax?: int|null,
     * } $summary
     */
    public static function with(array $lineItems, Summary|array $summary): self
    {
        $self = new self;

        $self['lineItems'] = $lineItems;
        $self['summary'] = $summary;

        return $self;
    }

    /**
     * @param list<Subscription|array{
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
     * }|Addon|array{
     *   id: string,
     *   currency: value-of<Currency>,
     *   name: string,
     *   prorationFactor: float,
     *   quantity: int,
     *   taxCategory: value-of<TaxCategory>,
     *   taxInclusive: bool,
     *   taxRate: float,
     *   type: value-of<Addon\Type>,
     *   unitPrice: int,
     *   description?: string|null,
     *   tax?: int|null,
     * }|Meter|array{
     *   id: string,
     *   chargeableUnits: string,
     *   currency: value-of<Currency>,
     *   freeThreshold: int,
     *   name: string,
     *   pricePerUnit: string,
     *   subtotal: int,
     *   taxInclusive: bool,
     *   taxRate: float,
     *   type: value-of<Meter\Type>,
     *   unitsConsumed: string,
     *   description?: string|null,
     *   tax?: int|null,
     * }> $lineItems
     */
    public function withLineItems(array $lineItems): self
    {
        $self = clone $this;
        $self['lineItems'] = $lineItems;

        return $self;
    }

    /**
     * @param Summary|array{
     *   currency: value-of<Currency>,
     *   customerCredits: int,
     *   settlementAmount: int,
     *   settlementCurrency: value-of<Currency>,
     *   totalAmount: int,
     *   settlementTax?: int|null,
     *   tax?: int|null,
     * } $summary
     */
    public function withSummary(Summary|array $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }
}
