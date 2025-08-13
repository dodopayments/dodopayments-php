<?php

declare(strict_types=1);

namespace DodopaymentsClient\Subscriptions;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Concerns\Params;
use DodopaymentsClient\Core\Contracts\BaseModel;
use DodopaymentsClient\Core\Conversion\ListOf;
use DodopaymentsClient\Subscriptions\SubscriptionChangePlanParams\ProrationBillingMode;

/**
 * @phpstan-type change_plan_params = array{
 *   productID: string,
 *   prorationBillingMode: ProrationBillingMode::*,
 *   quantity: int,
 *   addons?: list<AttachAddon>|null,
 * }
 */
final class SubscriptionChangePlanParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Unique identifier of the product to subscribe to.
     */
    #[Api('product_id')]
    public string $productID;

    /**
     * Proration Billing Mode.
     *
     * @var ProrationBillingMode::* $prorationBillingMode
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
     * @var null|list<AttachAddon> $addons
     */
    #[Api(type: new ListOf(AttachAddon::class), nullable: true, optional: true)]
    public ?array $addons;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param ProrationBillingMode::* $prorationBillingMode
     * @param null|list<AttachAddon> $addons
     */
    public static function from(
        string $productID,
        string $prorationBillingMode,
        int $quantity,
        ?array $addons = null,
    ): self {
        $obj = new self;

        $obj->productID = $productID;
        $obj->prorationBillingMode = $prorationBillingMode;
        $obj->quantity = $quantity;

        null !== $addons && $obj->addons = $addons;

        return $obj;
    }

    /**
     * Unique identifier of the product to subscribe to.
     */
    public function setProductID(string $productID): self
    {
        $this->productID = $productID;

        return $this;
    }

    /**
     * Proration Billing Mode.
     *
     * @param ProrationBillingMode::* $prorationBillingMode
     */
    public function setProrationBillingMode(string $prorationBillingMode): self
    {
        $this->prorationBillingMode = $prorationBillingMode;

        return $this;
    }

    /**
     * Number of units to subscribe for. Must be at least 1.
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Addons for the new plan.
     * Note : Leaving this empty would remove any existing addons.
     *
     * @param null|list<AttachAddon> $addons
     */
    public function setAddons(?array $addons): self
    {
        $this->addons = $addons;

        return $this;
    }
}
