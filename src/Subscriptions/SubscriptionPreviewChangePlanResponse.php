<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Required;
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
 *   immediateCharge: ImmediateCharge, newPlan: Subscription
 * }
 */
final class SubscriptionPreviewChangePlanResponse implements BaseModel
{
    /** @use SdkModel<SubscriptionPreviewChangePlanResponseShape> */
    use SdkModel;

    #[Required('immediate_charge')]
    public ImmediateCharge $immediateCharge;

    /**
     * Response struct representing subscription details.
     */
    #[Required('new_plan')]
    public Subscription $newPlan;

    /**
     * `new SubscriptionPreviewChangePlanResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionPreviewChangePlanResponse::with(immediateCharge: ..., newPlan: ...)
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
     *   lineItems: list<UnionMember0|UnionMember1|UnionMember2>, summary: Summary
     * } $immediateCharge
     * @param Subscription|array{
     *   addons: list<AddonCartResponseItem>,
     *   billing: BillingAddress,
     *   cancelAtNextBillingDate: bool,
     *   createdAt: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   metadata: array<string,string>,
     *   meters: list<Meter>,
     *   nextBillingDate: \DateTimeInterface,
     *   onDemand: bool,
     *   paymentFrequencyCount: int,
     *   paymentFrequencyInterval: value-of<TimeInterval>,
     *   previousBillingDate: \DateTimeInterface,
     *   productID: string,
     *   quantity: int,
     *   recurringPreTaxAmount: int,
     *   status: value-of<SubscriptionStatus>,
     *   subscriptionID: string,
     *   subscriptionPeriodCount: int,
     *   subscriptionPeriodInterval: value-of<TimeInterval>,
     *   taxInclusive: bool,
     *   trialPeriodDays: int,
     *   cancelledAt?: \DateTimeInterface|null,
     *   discountCyclesRemaining?: int|null,
     *   discountID?: string|null,
     *   expiresAt?: \DateTimeInterface|null,
     *   paymentMethodID?: string|null,
     *   taxID?: string|null,
     * } $newPlan
     */
    public static function with(
        ImmediateCharge|array $immediateCharge,
        Subscription|array $newPlan
    ): self {
        $obj = new self;

        $obj['immediateCharge'] = $immediateCharge;
        $obj['newPlan'] = $newPlan;

        return $obj;
    }

    /**
     * @param ImmediateCharge|array{
     *   lineItems: list<UnionMember0|UnionMember1|UnionMember2>, summary: Summary
     * } $immediateCharge
     */
    public function withImmediateCharge(
        ImmediateCharge|array $immediateCharge
    ): self {
        $obj = clone $this;
        $obj['immediateCharge'] = $immediateCharge;

        return $obj;
    }

    /**
     * Response struct representing subscription details.
     *
     * @param Subscription|array{
     *   addons: list<AddonCartResponseItem>,
     *   billing: BillingAddress,
     *   cancelAtNextBillingDate: bool,
     *   createdAt: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   metadata: array<string,string>,
     *   meters: list<Meter>,
     *   nextBillingDate: \DateTimeInterface,
     *   onDemand: bool,
     *   paymentFrequencyCount: int,
     *   paymentFrequencyInterval: value-of<TimeInterval>,
     *   previousBillingDate: \DateTimeInterface,
     *   productID: string,
     *   quantity: int,
     *   recurringPreTaxAmount: int,
     *   status: value-of<SubscriptionStatus>,
     *   subscriptionID: string,
     *   subscriptionPeriodCount: int,
     *   subscriptionPeriodInterval: value-of<TimeInterval>,
     *   taxInclusive: bool,
     *   trialPeriodDays: int,
     *   cancelledAt?: \DateTimeInterface|null,
     *   discountCyclesRemaining?: int|null,
     *   discountID?: string|null,
     *   expiresAt?: \DateTimeInterface|null,
     *   paymentMethodID?: string|null,
     *   taxID?: string|null,
     * } $newPlan
     */
    public function withNewPlan(Subscription|array $newPlan): self
    {
        $obj = clone $this;
        $obj['newPlan'] = $newPlan;

        return $obj;
    }
}
