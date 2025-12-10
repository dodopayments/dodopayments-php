<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Response struct representing subscription details.
 *
 * @phpstan-type AddonCartResponseItemShape = array{addonID: string, quantity: int}
 */
final class AddonCartResponseItem implements BaseModel
{
    /** @use SdkModel<AddonCartResponseItemShape> */
    use SdkModel;

    #[Required('addon_id')]
    public string $addonID;

    #[Required]
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
        $self = new self;

        $self['addonID'] = $addonID;
        $self['quantity'] = $quantity;

        return $self;
    }

    public function withAddonID(string $addonID): self
    {
        $self = clone $this;
        $self['addonID'] = $addonID;

        return $self;
    }

    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }
}
