<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams\ProrationBillingMode;

/**
 * @see Dodopayments\Services\SubscriptionsService::changePlan()
 *
 * @phpstan-type SubscriptionChangePlanParamsShape = array{
 *   product_id: string,
 *   proration_billing_mode: ProrationBillingMode|value-of<ProrationBillingMode>,
 *   quantity: int,
 *   addons?: list<AttachAddon|array{addon_id: string, quantity: int}>|null,
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
    #[Required]
    public string $product_id;

    /**
     * Proration Billing Mode.
     *
     * @var value-of<ProrationBillingMode> $proration_billing_mode
     */
    #[Required(enum: ProrationBillingMode::class)]
    public string $proration_billing_mode;

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
     * `new SubscriptionChangePlanParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionChangePlanParams::with(
     *   product_id: ..., proration_billing_mode: ..., quantity: ...
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
     * @param ProrationBillingMode|value-of<ProrationBillingMode> $proration_billing_mode
     * @param list<AttachAddon|array{addon_id: string, quantity: int}>|null $addons
     */
    public static function with(
        string $product_id,
        ProrationBillingMode|string $proration_billing_mode,
        int $quantity,
        ?array $addons = null,
    ): self {
        $obj = new self;

        $obj['product_id'] = $product_id;
        $obj['proration_billing_mode'] = $proration_billing_mode;
        $obj['quantity'] = $quantity;

        null !== $addons && $obj['addons'] = $addons;

        return $obj;
    }

    /**
     * Unique identifier of the product to subscribe to.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj['product_id'] = $productID;

        return $obj;
    }

    /**
     * Proration Billing Mode.
     *
     * @param ProrationBillingMode|value-of<ProrationBillingMode> $prorationBillingMode
     */
    public function withProrationBillingMode(
        ProrationBillingMode|string $prorationBillingMode
    ): self {
        $obj = clone $this;
        $obj['proration_billing_mode'] = $prorationBillingMode;

        return $obj;
    }

    /**
     * Number of units to subscribe for. Must be at least 1.
     */
    public function withQuantity(int $quantity): self
    {
        $obj = clone $this;
        $obj['quantity'] = $quantity;

        return $obj;
    }

    /**
     * Addons for the new plan.
     * Note : Leaving this empty would remove any existing addons.
     *
     * @param list<AttachAddon|array{addon_id: string, quantity: int}>|null $addons
     */
    public function withAddons(?array $addons): self
    {
        $obj = clone $this;
        $obj['addons'] = $addons;

        return $obj;
    }
}
