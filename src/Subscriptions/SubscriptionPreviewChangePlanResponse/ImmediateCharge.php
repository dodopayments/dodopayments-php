<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\Addon;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\Meter;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\Subscription;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\Summary;

/**
 * @phpstan-import-type LineItemShape from \Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem
 * @phpstan-import-type SummaryShape from \Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\Summary
 *
 * @phpstan-type ImmediateChargeShape = array{
 *   lineItems: list<LineItemShape>, summary: Summary|SummaryShape
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
     * @param list<LineItemShape> $lineItems
     * @param Summary|SummaryShape $summary
     */
    public static function with(array $lineItems, Summary|array $summary): self
    {
        $self = new self;

        $self['lineItems'] = $lineItems;
        $self['summary'] = $summary;

        return $self;
    }

    /**
     * @param list<LineItemShape> $lineItems
     */
    public function withLineItems(array $lineItems): self
    {
        $self = clone $this;
        $self['lineItems'] = $lineItems;

        return $self;
    }

    /**
     * @param Summary|SummaryShape $summary
     */
    public function withSummary(Summary|array $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }
}
