<?php

declare(strict_types=1);

namespace DodoPayments\Subscriptions;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * Response struct representing subscription details.
 *
 * @phpstan-type addon_cart_response_item_alias = array{
 *   addonID: string, quantity: int
 * }
 */
final class AddonCartResponseItem implements BaseModel
{
    use Model;

    #[Api('addon_id')]
    public string $addonID;

    #[Api]
    public int $quantity;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function from(string $addonID, int $quantity): self
    {
        $obj = new self;

        $obj->addonID = $addonID;
        $obj->quantity = $quantity;

        return $obj;
    }

    public function setAddonID(string $addonID): self
    {
        $this->addonID = $addonID;

        return $this;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
