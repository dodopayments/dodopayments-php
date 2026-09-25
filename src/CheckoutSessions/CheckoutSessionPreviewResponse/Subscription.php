<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * The quote of one subscription in a cart of several.
 *
 * @phpstan-type SubscriptionShape = array{
 *   amountDueNow: int,
 *   productID: string,
 *   recurringAmount: int,
 *   nextBillingDate?: \DateTimeInterface|null,
 *   recurringTax?: int|null,
 *   taxDueNow?: int|null,
 *   trialPeriodDays?: int|null,
 * }
 */
final class Subscription implements BaseModel
{
    /** @use SdkModel<SubscriptionShape> */
    use SdkModel;

    /**
     * The amount this subscription charges today, including tax.
     */
    #[Required('amount_due_now')]
    public int $amountDueNow;

    /**
     * The subscription product.
     */
    #[Required('product_id')]
    public string $productID;

    /**
     * The amount of each renewal, including tax.
     */
    #[Required('recurring_amount')]
    public int $recurringAmount;

    /**
     * A preview of the first renewal date. The date is set when the subscription activates.
     */
    #[Optional('next_billing_date', nullable: true)]
    public ?\DateTimeInterface $nextBillingDate;

    /**
     * The tax in `recurring_amount`.
     */
    #[Optional('recurring_tax', nullable: true)]
    public ?int $recurringTax;

    /**
     * The tax in `amount_due_now`.
     */
    #[Optional('tax_due_now', nullable: true)]
    public ?int $taxDueNow;

    /**
     * The trial duration in days. `None` when the subscription has no trial.
     */
    #[Optional('trial_period_days', nullable: true)]
    public ?int $trialPeriodDays;

    /**
     * `new Subscription()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Subscription::with(amountDueNow: ..., productID: ..., recurringAmount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Subscription)
     *   ->withAmountDueNow(...)
     *   ->withProductID(...)
     *   ->withRecurringAmount(...)
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
     */
    public static function with(
        int $amountDueNow,
        string $productID,
        int $recurringAmount,
        ?\DateTimeInterface $nextBillingDate = null,
        ?int $recurringTax = null,
        ?int $taxDueNow = null,
        ?int $trialPeriodDays = null,
    ): self {
        $self = new self;

        $self['amountDueNow'] = $amountDueNow;
        $self['productID'] = $productID;
        $self['recurringAmount'] = $recurringAmount;

        null !== $nextBillingDate && $self['nextBillingDate'] = $nextBillingDate;
        null !== $recurringTax && $self['recurringTax'] = $recurringTax;
        null !== $taxDueNow && $self['taxDueNow'] = $taxDueNow;
        null !== $trialPeriodDays && $self['trialPeriodDays'] = $trialPeriodDays;

        return $self;
    }

    /**
     * The amount this subscription charges today, including tax.
     */
    public function withAmountDueNow(int $amountDueNow): self
    {
        $self = clone $this;
        $self['amountDueNow'] = $amountDueNow;

        return $self;
    }

    /**
     * The subscription product.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * The amount of each renewal, including tax.
     */
    public function withRecurringAmount(int $recurringAmount): self
    {
        $self = clone $this;
        $self['recurringAmount'] = $recurringAmount;

        return $self;
    }

    /**
     * A preview of the first renewal date. The date is set when the subscription activates.
     */
    public function withNextBillingDate(
        ?\DateTimeInterface $nextBillingDate
    ): self {
        $self = clone $this;
        $self['nextBillingDate'] = $nextBillingDate;

        return $self;
    }

    /**
     * The tax in `recurring_amount`.
     */
    public function withRecurringTax(?int $recurringTax): self
    {
        $self = clone $this;
        $self['recurringTax'] = $recurringTax;

        return $self;
    }

    /**
     * The tax in `amount_due_now`.
     */
    public function withTaxDueNow(?int $taxDueNow): self
    {
        $self = clone $this;
        $self['taxDueNow'] = $taxDueNow;

        return $self;
    }

    /**
     * The trial duration in days. `None` when the subscription has no trial.
     */
    public function withTrialPeriodDays(?int $trialPeriodDays): self
    {
        $self = clone $this;
        $self['trialPeriodDays'] = $trialPeriodDays;

        return $self;
    }
}
