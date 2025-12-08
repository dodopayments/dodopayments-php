<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse;

use Dodopayments\Core\Attributes\Api;
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
 *   line_items: list<UnionMember0|UnionMember1|UnionMember2>, summary: Summary
 * }
 */
final class ImmediateCharge implements BaseModel
{
    /** @use SdkModel<ImmediateChargeShape> */
    use SdkModel;

    /** @var list<UnionMember0|UnionMember1|UnionMember2> $line_items */
    #[Api(list: LineItem::class)]
    public array $line_items;

    #[Api]
    public Summary $summary;

    /**
     * `new ImmediateCharge()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ImmediateCharge::with(line_items: ..., summary: ...)
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
     * }|UnionMember1|array{
     *   id: string,
     *   currency: value-of<Currency>,
     *   name: string,
     *   proration_factor: float,
     *   quantity: int,
     *   tax_category: value-of<TaxCategory>,
     *   tax_inclusive: bool,
     *   tax_rate: float,
     *   type: value-of<UnionMember1\Type>,
     *   unit_price: int,
     *   description?: string|null,
     *   tax?: int|null,
     * }|UnionMember2|array{
     *   id: string,
     *   chargeable_units: string,
     *   currency: value-of<Currency>,
     *   free_threshold: int,
     *   name: string,
     *   price_per_unit: string,
     *   subtotal: int,
     *   tax_inclusive: bool,
     *   tax_rate: float,
     *   type: value-of<UnionMember2\Type>,
     *   units_consumed: string,
     *   description?: string|null,
     *   tax?: int|null,
     * }> $line_items
     * @param Summary|array{
     *   currency: value-of<Currency>,
     *   customer_credits: int,
     *   settlement_amount: int,
     *   settlement_currency: value-of<Currency>,
     *   total_amount: int,
     *   settlement_tax?: int|null,
     *   tax?: int|null,
     * } $summary
     */
    public static function with(array $line_items, Summary|array $summary): self
    {
        $obj = new self;

        $obj['line_items'] = $line_items;
        $obj['summary'] = $summary;

        return $obj;
    }

    /**
     * @param list<UnionMember0|array{
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
     * }|UnionMember1|array{
     *   id: string,
     *   currency: value-of<Currency>,
     *   name: string,
     *   proration_factor: float,
     *   quantity: int,
     *   tax_category: value-of<TaxCategory>,
     *   tax_inclusive: bool,
     *   tax_rate: float,
     *   type: value-of<UnionMember1\Type>,
     *   unit_price: int,
     *   description?: string|null,
     *   tax?: int|null,
     * }|UnionMember2|array{
     *   id: string,
     *   chargeable_units: string,
     *   currency: value-of<Currency>,
     *   free_threshold: int,
     *   name: string,
     *   price_per_unit: string,
     *   subtotal: int,
     *   tax_inclusive: bool,
     *   tax_rate: float,
     *   type: value-of<UnionMember2\Type>,
     *   units_consumed: string,
     *   description?: string|null,
     *   tax?: int|null,
     * }> $lineItems
     */
    public function withLineItems(array $lineItems): self
    {
        $obj = clone $this;
        $obj['line_items'] = $lineItems;

        return $obj;
    }

    /**
     * @param Summary|array{
     *   currency: value-of<Currency>,
     *   customer_credits: int,
     *   settlement_amount: int,
     *   settlement_currency: value-of<Currency>,
     *   total_amount: int,
     *   settlement_tax?: int|null,
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
