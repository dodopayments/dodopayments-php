<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Request struct for attaching an entitlement to a product.
 *
 * Mirrors the `credit_entitlements` attach shape — every "attach something
 * to a product" array takes objects, not bare IDs. Uniform shape leaves
 * room for per-attachment settings later without another API break.
 *
 * @phpstan-type AttachProductEntitlementShape = array{entitlementID: string}
 */
final class AttachProductEntitlement implements BaseModel
{
    /** @use SdkModel<AttachProductEntitlementShape> */
    use SdkModel;

    /**
     * ID of the entitlement to attach to the product.
     */
    #[Required('entitlement_id')]
    public string $entitlementID;

    /**
     * `new AttachProductEntitlement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AttachProductEntitlement::with(entitlementID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AttachProductEntitlement)->withEntitlementID(...)
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
    public static function with(string $entitlementID): self
    {
        $self = new self;

        $self['entitlementID'] = $entitlementID;

        return $self;
    }

    /**
     * ID of the entitlement to attach to the product.
     */
    public function withEntitlementID(string $entitlementID): self
    {
        $self = clone $this;
        $self['entitlementID'] = $entitlementID;

        return $self;
    }
}
