<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Subscriptions\Subscription\Meter;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\UnionMember0;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\UnionMember1;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\LineItem\UnionMember2;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge\Summary;

/**
 * @phpstan-type SubscriptionPreviewChangePlanResponseShape = array{
 *   immediate_charge: ImmediateCharge, new_plan: Subscription
 * }
 */
final class SubscriptionPreviewChangePlanResponse implements BaseModel
{
    /** @use SdkModel<SubscriptionPreviewChangePlanResponseShape> */
    use SdkModel;

    #[Api]
    public ImmediateCharge $immediate_charge;

    /**
     * Response struct representing subscription details.
     */
    #[Api]
    public Subscription $new_plan;

    /**
     * `new SubscriptionPreviewChangePlanResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionPreviewChangePlanResponse::with(
     *   immediate_charge: ..., new_plan: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionPreviewChangePlanResponse)
     *   ->withImmediateCharge(...)
     *   ->withNewPlan(...)
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
     * @param ImmediateCharge|array{
     *   line_items: list<UnionMember0|UnionMember1|UnionMember2>, summary: Summary
     * } $immediate_charge
     * @param Subscription|array{
     *   addons: list<AddonCartResponseItem>,
     *   billing: BillingAddress,
     *   cancel_at_next_billing_date: bool,
     *   created_at: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   metadata: array<string,string>,
     *   meters: list<Meter>,
     *   next_billing_date: \DateTimeInterface,
     *   on_demand: bool,
     *   payment_frequency_count: int,
     *   payment_frequency_interval: value-of<TimeInterval>,
     *   previous_billing_date: \DateTimeInterface,
     *   product_id: string,
     *   quantity: int,
     *   recurring_pre_tax_amount: int,
     *   status: value-of<SubscriptionStatus>,
     *   subscription_id: string,
     *   subscription_period_count: int,
     *   subscription_period_interval: value-of<TimeInterval>,
     *   tax_inclusive: bool,
     *   trial_period_days: int,
     *   cancelled_at?: \DateTimeInterface|null,
     *   discount_cycles_remaining?: int|null,
     *   discount_id?: string|null,
     *   expires_at?: \DateTimeInterface|null,
     *   payment_method_id?: string|null,
     *   tax_id?: string|null,
     * } $new_plan
     */
    public static function with(
        ImmediateCharge|array $immediate_charge,
        Subscription|array $new_plan
    ): self {
        $obj = new self;

        $obj['immediate_charge'] = $immediate_charge;
        $obj['new_plan'] = $new_plan;

        return $obj;
    }

    /**
     * @param ImmediateCharge|array{
     *   line_items: list<UnionMember0|UnionMember1|UnionMember2>, summary: Summary
     * } $immediateCharge
     */
    public function withImmediateCharge(
        ImmediateCharge|array $immediateCharge
    ): self {
        $obj = clone $this;
        $obj['immediate_charge'] = $immediateCharge;

        return $obj;
    }

    /**
     * Response struct representing subscription details.
     *
     * @param Subscription|array{
     *   addons: list<AddonCartResponseItem>,
     *   billing: BillingAddress,
     *   cancel_at_next_billing_date: bool,
     *   created_at: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   metadata: array<string,string>,
     *   meters: list<Meter>,
     *   next_billing_date: \DateTimeInterface,
     *   on_demand: bool,
     *   payment_frequency_count: int,
     *   payment_frequency_interval: value-of<TimeInterval>,
     *   previous_billing_date: \DateTimeInterface,
     *   product_id: string,
     *   quantity: int,
     *   recurring_pre_tax_amount: int,
     *   status: value-of<SubscriptionStatus>,
     *   subscription_id: string,
     *   subscription_period_count: int,
     *   subscription_period_interval: value-of<TimeInterval>,
     *   tax_inclusive: bool,
     *   trial_period_days: int,
     *   cancelled_at?: \DateTimeInterface|null,
     *   discount_cycles_remaining?: int|null,
     *   discount_id?: string|null,
     *   expires_at?: \DateTimeInterface|null,
     *   payment_method_id?: string|null,
     *   tax_id?: string|null,
     * } $newPlan
     */
    public function withNewPlan(Subscription|array $newPlan): self
    {
        $obj = clone $this;
        $obj['new_plan'] = $newPlan;

        return $obj;
    }
}
