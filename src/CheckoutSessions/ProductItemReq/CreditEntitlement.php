<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\ProductItemReq;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Per-checkout-session override for a single credit entitlement attached to a product.
 *
 * @phpstan-type CreditEntitlementShape = array{
 *   creditEntitlementID: string, creditsAmount: string
 * }
 */
final class CreditEntitlement implements BaseModel
{
    /** @use SdkModel<CreditEntitlementShape> */
    use SdkModel;

    /**
     * ID of the credit entitlement to override. Must already be attached to the product.
     */
    #[Required('credit_entitlement_id')]
    public string $creditEntitlementID;

    /**
     * Number of credits to grant for this checkout session, overriding the
     * product-level `credits_amount` set on the credit entitlement mapping.
     * Must be greater than zero.
     */
    #[Required('credits_amount')]
    public string $creditsAmount;

    /**
     * `new CreditEntitlement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditEntitlement::with(creditEntitlementID: ..., creditsAmount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditEntitlement)->withCreditEntitlementID(...)->withCreditsAmount(...)
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
        string $creditEntitlementID,
        string $creditsAmount
    ): self {
        $self = new self;

        $self['creditEntitlementID'] = $creditEntitlementID;
        $self['creditsAmount'] = $creditsAmount;

        return $self;
    }

    /**
     * ID of the credit entitlement to override. Must already be attached to the product.
     */
    public function withCreditEntitlementID(string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }

    /**
     * Number of credits to grant for this checkout session, overriding the
     * product-level `credits_amount` set on the credit entitlement mapping.
     * Must be greater than zero.
     */
    public function withCreditsAmount(string $creditsAmount): self
    {
        $self = clone $this;
        $self['creditsAmount'] = $creditsAmount;

        return $self;
    }
}
