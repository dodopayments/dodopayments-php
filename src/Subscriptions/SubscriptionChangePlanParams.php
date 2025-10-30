<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams\ProrationBillingMode;

/**
 * @see Dodopayments\Subscriptions->changePlan
 *
 * @phpstan-type SubscriptionChangePlanParamsShape = array{
 *   productID: string,
 *   prorationBillingMode: ProrationBillingMode|value-of<ProrationBillingMode>,
 *   quantity: int,
 *   addons?: list<AttachAddon>|null,
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
    #[Api('product_id')]
    public string $productID;

    /**
     * Proration Billing Mode.
     *
     * @var value-of<ProrationBillingMode> $prorationBillingMode
     */
    #[Api('proration_billing_mode', enum: ProrationBillingMode::class)]
    public string $prorationBillingMode;

    /**
     * Number of units to subscribe for. Must be at least 1.
     */
    #[Api]
    public int $quantity;

    /**
     * Addons for the new plan.
     * Note : Leaving this empty would remove any existing addons.
     *
     * @var list<AttachAddon>|null $addons
     */
    #[Api(list: AttachAddon::class, nullable: true, optional: true)]
    public ?array $addons;

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
     * @param list<AttachAddon>|null $addons
     */
    public static function with(
        string $productID,
        ProrationBillingMode|string $prorationBillingMode,
        int $quantity,
        ?array $addons = null,
    ): self {
        $obj = new self;

        $obj->productID = $productID;
        $obj['prorationBillingMode'] = $prorationBillingMode;
        $obj->quantity = $quantity;

        null !== $addons && $obj->addons = $addons;

        return $obj;
    }

    /**
     * Unique identifier of the product to subscribe to.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj->productID = $productID;

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
        $obj['prorationBillingMode'] = $prorationBillingMode;

        return $obj;
    }

    /**
     * Number of units to subscribe for. Must be at least 1.
     */
    public function withQuantity(int $quantity): self
    {
        $obj = clone $this;
        $obj->quantity = $quantity;

        return $obj;
    }

    /**
     * Addons for the new plan.
     * Note : Leaving this empty would remove any existing addons.
     *
     * @param list<AttachAddon>|null $addons
     */
    public function withAddons(?array $addons): self
    {
        $obj = clone $this;
        $obj->addons = $addons;

        return $obj;
    }
}
