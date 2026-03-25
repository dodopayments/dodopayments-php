<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\UpdateSubscriptionPlanReq\EffectiveAt;
use Dodopayments\Subscriptions\UpdateSubscriptionPlanReq\OnPaymentFailure;
use Dodopayments\Subscriptions\UpdateSubscriptionPlanReq\ProrationBillingMode;

/**
 * @phpstan-import-type AttachAddonShape from \Dodopayments\Subscriptions\AttachAddon
 *
 * @phpstan-type UpdateSubscriptionPlanReqShape = array{
 *   productID: string,
 *   prorationBillingMode: ProrationBillingMode|value-of<ProrationBillingMode>,
 *   quantity: int,
 *   addons?: list<AttachAddon|AttachAddonShape>|null,
 *   discountCode?: string|null,
 *   effectiveAt?: null|EffectiveAt|value-of<EffectiveAt>,
 *   metadata?: array<string,string>|null,
 *   onPaymentFailure?: null|OnPaymentFailure|value-of<OnPaymentFailure>,
 * }
 */
final class UpdateSubscriptionPlanReq implements BaseModel
{
    /** @use SdkModel<UpdateSubscriptionPlanReqShape> */
    use SdkModel;

    /**
     * Unique identifier of the product to subscribe to.
     */
    #[Required('product_id')]
    public string $productID;

    /**
     * Proration Billing Mode.
     *
     * @var value-of<ProrationBillingMode> $prorationBillingMode
     */
    #[Required('proration_billing_mode', enum: ProrationBillingMode::class)]
    public string $prorationBillingMode;

    /**
     * Number of units to subscribe for. Must be at least 1.
     */
    #[Required]
    public int $quantity;

    /**
     * Addons for the new plan.
     * Note : Leaving this empty would remove any existing addons.
     *
     * @var list<AttachAddon>|null $addons
     */
    #[Optional(list: AttachAddon::class, nullable: true)]
    public ?array $addons;

    /**
     * Optional discount code to apply to the new plan.
     * If provided, validates and applies the discount to the plan change.
     * If not provided and the subscription has an existing discount with `preserve_on_plan_change=true`,
     * the existing discount will be preserved (if applicable to the new product).
     */
    #[Optional('discount_code', nullable: true)]
    public ?string $discountCode;

    /**
     * When to apply the plan change.
     * - `immediately` (default): Apply the plan change right away
     * - `next_billing_date`: Schedule the change for the next billing date.
     *
     * @var value-of<EffectiveAt>|null $effectiveAt
     */
    #[Optional('effective_at', enum: EffectiveAt::class)]
    public ?string $effectiveAt;

    /**
     * Metadata for the payment. If not passed, the metadata of the subscription will be taken.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string', nullable: true)]
    public ?array $metadata;

    /**
     * Controls behavior when the plan change payment fails.
     * - `prevent_change`: Keep subscription on current plan until payment succeeds
     * - `apply_change` (default): Apply plan change immediately regardless of payment outcome.
     *
     * If not specified, uses the business-level default setting.
     *
     * @var value-of<OnPaymentFailure>|null $onPaymentFailure
     */
    #[Optional(
        'on_payment_failure',
        enum: OnPaymentFailure::class,
        nullable: true
    )]
    public ?string $onPaymentFailure;

    /**
     * `new UpdateSubscriptionPlanReq()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UpdateSubscriptionPlanReq::with(
     *   productID: ..., prorationBillingMode: ..., quantity: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UpdateSubscriptionPlanReq)
     *   ->withProductID(...)
     *   ->withProrationBillingMode(...)
     *   ->withQuantity(...)
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
     * @param ProrationBillingMode|value-of<ProrationBillingMode> $prorationBillingMode
     * @param list<AttachAddon|AttachAddonShape>|null $addons
     * @param EffectiveAt|value-of<EffectiveAt>|null $effectiveAt
     * @param array<string,string>|null $metadata
     * @param OnPaymentFailure|value-of<OnPaymentFailure>|null $onPaymentFailure
     */
    public static function with(
        string $productID,
        ProrationBillingMode|string $prorationBillingMode,
        int $quantity,
        ?array $addons = null,
        ?string $discountCode = null,
        EffectiveAt|string|null $effectiveAt = null,
        ?array $metadata = null,
        OnPaymentFailure|string|null $onPaymentFailure = null,
    ): self {
        $self = new self;

        $self['productID'] = $productID;
        $self['prorationBillingMode'] = $prorationBillingMode;
        $self['quantity'] = $quantity;

        null !== $addons && $self['addons'] = $addons;
        null !== $discountCode && $self['discountCode'] = $discountCode;
        null !== $effectiveAt && $self['effectiveAt'] = $effectiveAt;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $onPaymentFailure && $self['onPaymentFailure'] = $onPaymentFailure;

        return $self;
    }

    /**
     * Unique identifier of the product to subscribe to.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * Proration Billing Mode.
     *
     * @param ProrationBillingMode|value-of<ProrationBillingMode> $prorationBillingMode
     */
    public function withProrationBillingMode(
        ProrationBillingMode|string $prorationBillingMode
    ): self {
        $self = clone $this;
        $self['prorationBillingMode'] = $prorationBillingMode;

        return $self;
    }

    /**
     * Number of units to subscribe for. Must be at least 1.
     */
    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * Addons for the new plan.
     * Note : Leaving this empty would remove any existing addons.
     *
     * @param list<AttachAddon|AttachAddonShape>|null $addons
     */
    public function withAddons(?array $addons): self
    {
        $self = clone $this;
        $self['addons'] = $addons;

        return $self;
    }

    /**
     * Optional discount code to apply to the new plan.
     * If provided, validates and applies the discount to the plan change.
     * If not provided and the subscription has an existing discount with `preserve_on_plan_change=true`,
     * the existing discount will be preserved (if applicable to the new product).
     */
    public function withDiscountCode(?string $discountCode): self
    {
        $self = clone $this;
        $self['discountCode'] = $discountCode;

        return $self;
    }

    /**
     * When to apply the plan change.
     * - `immediately` (default): Apply the plan change right away
     * - `next_billing_date`: Schedule the change for the next billing date.
     *
     * @param EffectiveAt|value-of<EffectiveAt> $effectiveAt
     */
    public function withEffectiveAt(EffectiveAt|string $effectiveAt): self
    {
        $self = clone $this;
        $self['effectiveAt'] = $effectiveAt;

        return $self;
    }

    /**
     * Metadata for the payment. If not passed, the metadata of the subscription will be taken.
     *
     * @param array<string,string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Controls behavior when the plan change payment fails.
     * - `prevent_change`: Keep subscription on current plan until payment succeeds
     * - `apply_change` (default): Apply plan change immediately regardless of payment outcome.
     *
     * If not specified, uses the business-level default setting.
     *
     * @param OnPaymentFailure|value-of<OnPaymentFailure>|null $onPaymentFailure
     */
    public function withOnPaymentFailure(
        OnPaymentFailure|string|null $onPaymentFailure
    ): self {
        $self = clone $this;
        $self['onPaymentFailure'] = $onPaymentFailure;

        return $self;
    }
}
