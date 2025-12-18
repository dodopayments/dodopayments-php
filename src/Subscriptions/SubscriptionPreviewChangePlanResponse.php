<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge;

/**
 * @phpstan-import-type ImmediateChargeShape from \Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge
 * @phpstan-import-type SubscriptionShape from \Dodopayments\Subscriptions\Subscription
 *
 * @phpstan-type SubscriptionPreviewChangePlanResponseShape = array{
 *   immediateCharge: ImmediateCharge|ImmediateChargeShape,
 *   newPlan: Subscription|SubscriptionShape,
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
     * @param ImmediateCharge|ImmediateChargeShape $immediateCharge
     * @param Subscription|SubscriptionShape $newPlan
     */
    public static function with(
        ImmediateCharge|array $immediateCharge,
        Subscription|array $newPlan
    ): self {
        $self = new self;

        $self['immediateCharge'] = $immediateCharge;
        $self['newPlan'] = $newPlan;

        return $self;
    }

    /**
     * @param ImmediateCharge|ImmediateChargeShape $immediateCharge
     */
    public function withImmediateCharge(
        ImmediateCharge|array $immediateCharge
    ): self {
        $self = clone $this;
        $self['immediateCharge'] = $immediateCharge;

        return $self;
    }

    /**
     * Response struct representing subscription details.
     *
     * @param Subscription|SubscriptionShape $newPlan
     */
    public function withNewPlan(Subscription|array $newPlan): self
    {
        $self = clone $this;
        $self['newPlan'] = $newPlan;

        return $self;
    }
}
