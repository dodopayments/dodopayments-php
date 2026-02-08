<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams\OnPaymentFailure;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams\ProrationBillingMode;

/**
 * @see Dodopayments\Services\SubscriptionsService::changePlan()
 *
 * @phpstan-import-type AttachAddonShape from \Dodopayments\Subscriptions\AttachAddon
 *
 * @phpstan-type SubscriptionChangePlanParamsShape = array{
 *   productID: string,
 *   prorationBillingMode: ProrationBillingMode|value-of<ProrationBillingMode>,
 *   quantity: int,
 *   addons?: list<AttachAddon|AttachAddonShape>|null,
 *   metadata?: array<string,string>|null,
 *   onPaymentFailure?: null|OnPaymentFailure|value-of<OnPaymentFailure>,
 * }
 */
final class SubscriptionChangePlanParams implements BaseModel
{
    /** @use SdkModel<SubscriptionChangePlanParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * `new SubscriptionChangePlanParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionChangePlanParams::with(
     *   productID: ..., prorationBillingMode: ..., quantity: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionChangePlanParams)
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
     * @param array<string,string>|null $metadata
     * @param OnPaymentFailure|value-of<OnPaymentFailure>|null $onPaymentFailure
     */
    public static function with(
        string $productID,
        ProrationBillingMode|string $prorationBillingMode,
        int $quantity,
        ?array $addons = null,
        ?array $metadata = null,
        OnPaymentFailure|string|null $onPaymentFailure = null,
    ): self {
        $self = new self;

        $self['productID'] = $productID;
        $self['prorationBillingMode'] = $prorationBillingMode;
        $self['quantity'] = $quantity;

        null !== $addons && $self['addons'] = $addons;
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
