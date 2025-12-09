<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Response struct representing subscription details.
 *
 * @phpstan-type AddonCartResponseItemShape = array{
 *   addon_id: string, quantity: int
 * }
 */
final class AddonCartResponseItem implements BaseModel
{
    /** @use SdkModel<AddonCartResponseItemShape> */
    use SdkModel;

    #[Required]
    public string $addon_id;

    #[Required]
    public int $quantity;

    /**
     * `new AddonCartResponseItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AddonCartResponseItem::with(addon_id: ..., quantity: ...)
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
    public static function with(string $addon_id, int $quantity): self
    {
        $obj = new self;

        $obj['addon_id'] = $addon_id;
        $obj['quantity'] = $quantity;

        return $obj;
    }

    public function withAddonID(string $addonID): self
    {
        $obj = clone $this;
        $obj['addon_id'] = $addonID;

        return $obj;
    }

    public function withQuantity(int $quantity): self
    {
        $obj = clone $this;
        $obj['quantity'] = $quantity;

        return $obj;
    }
}
