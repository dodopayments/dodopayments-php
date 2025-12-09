<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\UnionMember0;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\UnionMember0\Type;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\UnionMember1;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\UnionMember2;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\Summary;

/**
 * @phpstan-type ImmediateChargeShape = array{
 *   lineItems: list<UnionMember0|UnionMember1|UnionMember2>, summary: Summary
 * }
 */
final class ImmediateCharge implements BaseModel
{
    /** @use SdkModel<ImmediateChargeShape> */
    use SdkModel;

    /** @var list<UnionMember0|UnionMember1|UnionMember2> $lineItems */
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
     * @param list<UnionMember0|array{
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
     * }|UnionMember1|array{
     *   id: string,
     *   currency: value-of<Currency>,
     *   name: string,
     *   prorationFactor: float,
     *   quantity: int,
     *   taxCategory: value-of<TaxCategory>,
     *   taxInclusive: bool,
     *   taxRate: float,
     *   type: value-of<UnionMember1\Type>,
     *   unitPrice: int,
     *   description?: string|null,
     *   tax?: int|null,
     * }|UnionMember2|array{
     *   id: string,
     *   chargeableUnits: string,
     *   currency: value-of<Currency>,
     *   freeThreshold: int,
     *   name: string,
     *   pricePerUnit: string,
     *   subtotal: int,
     *   taxInclusive: bool,
     *   taxRate: float,
     *   type: value-of<UnionMember2\Type>,
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
        $obj = new self;

        $obj['lineItems'] = $lineItems;
        $obj['summary'] = $summary;

        return $obj;
    }

    /**
     * @param list<UnionMember0|array{
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
     * }|UnionMember1|array{
     *   id: string,
     *   currency: value-of<Currency>,
     *   name: string,
     *   prorationFactor: float,
     *   quantity: int,
     *   taxCategory: value-of<TaxCategory>,
     *   taxInclusive: bool,
     *   taxRate: float,
     *   type: value-of<UnionMember1\Type>,
     *   unitPrice: int,
     *   description?: string|null,
     *   tax?: int|null,
     * }|UnionMember2|array{
     *   id: string,
     *   chargeableUnits: string,
     *   currency: value-of<Currency>,
     *   freeThreshold: int,
     *   name: string,
     *   pricePerUnit: string,
     *   subtotal: int,
     *   taxInclusive: bool,
     *   taxRate: float,
     *   type: value-of<UnionMember2\Type>,
     *   unitsConsumed: string,
     *   description?: string|null,
     *   tax?: int|null,
     * }> $lineItems
     */
    public function withLineItems(array $lineItems): self
    {
        $obj = clone $this;
        $obj['lineItems'] = $lineItems;

        return $obj;
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
        $obj = clone $this;
        $obj['summary'] = $summary;

        return $obj;
    }
}
