<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\Subscription\ScheduledChange;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type AddonShape = array{addonID: string, name: string, quantity: int}
 */
final class Addon implements BaseModel
{
    /** @use SdkModel<AddonShape> */
    use SdkModel;

    /**
     * The addon ID.
     */
    #[Required('addon_id')]
    public string $addonID;

    /**
     * Name of the addon.
     */
    #[Required]
    public string $name;

    /**
     * Quantity of the addon.
     */
    #[Required]
    public int $quantity;

    /**
     * `new Addon()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Addon::with(addonID: ..., name: ..., quantity: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Addon)->withAddonID(...)->withName(...)->withQuantity(...)
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
    public static function with(
        string $addonID,
        string $name,
        int $quantity
    ): self {
        $self = new self;

        $self['addonID'] = $addonID;
        $self['name'] = $name;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * The addon ID.
     */
    public function withAddonID(string $addonID): self
    {
        $self = clone $this;
        $self['addonID'] = $addonID;

        return $self;
    }

    /**
     * Name of the addon.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Quantity of the addon.
     */
    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }
}
