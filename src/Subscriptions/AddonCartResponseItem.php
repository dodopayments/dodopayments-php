<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Response struct representing subscription details.
 *
 * @phpstan-type addon_cart_response_item = array{addonID: string, quantity: int}
 */
final class AddonCartResponseItem implements BaseModel
{
    /** @use SdkModel<addon_cart_response_item> */
    use SdkModel;

    #[Api('addon_id')]
    public string $addonID;

    #[Api]
    public int $quantity;

    /**
     * `new AddonCartResponseItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AddonCartResponseItem::with(addonID: ..., quantity: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AddonCartResponseItem)->withAddonID(...)->withQuantity(...)
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
    public static function with(string $addonID, int $quantity): self
    {
        $obj = new self;

        $obj->addonID = $addonID;
        $obj->quantity = $quantity;

        return $obj;
    }

    public function withAddonID(string $addonID): self
    {
        $obj = clone $this;
        $obj->addonID = $addonID;

        return $obj;
    }

    public function withQuantity(int $quantity): self
    {
        $obj = clone $this;
        $obj->quantity = $quantity;

        return $obj;
    }
}
