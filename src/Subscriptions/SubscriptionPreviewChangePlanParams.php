<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanParams\ProrationBillingMode;

/**
 * @see Dodopayments\Services\SubscriptionsService::previewChangePlan()
 *
 * @phpstan-type SubscriptionPreviewChangePlanParamsShape = array{
 *   productID: string,
 *   prorationBillingMode: ProrationBillingMode|value-of<ProrationBillingMode>,
 *   quantity: int,
 *   addons?: list<AttachAddon|array{addonID: string, quantity: int}>|null,
 * }
 */
final class SubscriptionPreviewChangePlanParams implements BaseModel
{
    /** @use SdkModel<SubscriptionPreviewChangePlanParamsShape> */
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
     * `new SubscriptionPreviewChangePlanParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionPreviewChangePlanParams::with(
     *   productID: ..., prorationBillingMode: ..., quantity: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionPreviewChangePlanParams)
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
     * @param list<AttachAddon|array{addonID: string, quantity: int}>|null $addons
     */
    public static function with(
        string $productID,
        ProrationBillingMode|string $prorationBillingMode,
        int $quantity,
        ?array $addons = null,
    ): self {
        $self = new self;

        $self['productID'] = $productID;
        $self['prorationBillingMode'] = $prorationBillingMode;
        $self['quantity'] = $quantity;

        null !== $addons && $self['addons'] = $addons;

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
     * @param list<AttachAddon|array{addonID: string, quantity: int}>|null $addons
     */
    public function withAddons(?array $addons): self
    {
        $self = clone $this;
        $self['addons'] = $addons;

        return $self;
    }
}
