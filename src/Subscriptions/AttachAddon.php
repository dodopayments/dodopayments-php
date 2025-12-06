<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type AttachAddonShape = array{addon_id: string, quantity: int}
 */
final class AttachAddon implements BaseModel
{
    /** @use SdkModel<AttachAddonShape> */
    use SdkModel;

    #[Api]
    public string $addon_id;

    #[Api]
    public int $quantity;

    /**
     * `new AttachAddon()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AttachAddon::with(addon_id: ..., quantity: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AttachAddon)->withAddonID(...)->withQuantity(...)
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
