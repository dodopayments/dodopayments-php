<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\Summary;

/**
 * @phpstan-import-type LineItemVariants from \Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem
 * @phpstan-import-type LineItemShape from \Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem
 * @phpstan-import-type SummaryShape from \Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\Summary
 *
 * @phpstan-type ImmediateChargeShape = array{
 *   effectiveAt: \DateTimeInterface,
 *   lineItems: list<LineItemShape>,
 *   summary: Summary|SummaryShape,
 * }
 */
final class ImmediateCharge implements BaseModel
{
    /** @use SdkModel<ImmediateChargeShape> */
    use SdkModel;

    /**
     * When the plan change will be effective.
     */
    #[Required('effective_at')]
    public \DateTimeInterface $effectiveAt;

    /** @var list<LineItemVariants> $lineItems */
    #[Required('line_items', list: LineItem::class)]
    public array $lineItems;

    #[Required]
    public Summary $summary;

    /**
     * `new ImmediateCharge()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ImmediateCharge::with(effectiveAt: ..., lineItems: ..., summary: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ImmediateCharge)
     *   ->withEffectiveAt(...)
     *   ->withLineItems(...)
     *   ->withSummary(...)
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
    public static function with(
        \DateTimeInterface $effectiveAt,
        array $lineItems,
        Summary|array $summary
    ): self {
        $self = new self;

        $self['effectiveAt'] = $effectiveAt;
        $self['lineItems'] = $lineItems;
        $self['summary'] = $summary;

        return $self;
    }

    /**
     * When the plan change will be effective.
     */
    public function withEffectiveAt(\DateTimeInterface $effectiveAt): self
    {
        $self = clone $this;
        $self['effectiveAt'] = $effectiveAt;

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
