<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse\ProductCart;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Minimal credit entitlement info shown at checkout — what credits the customer will receive.
 *
 * @phpstan-type CreditEntitlementShape = array{
 *   creditEntitlementID: string,
 *   creditEntitlementName: string,
 *   creditEntitlementUnit: string,
 *   creditsAmount: string,
 * }
 */
final class CreditEntitlement implements BaseModel
{
    /** @use SdkModel<CreditEntitlementShape> */
    use SdkModel;

    /**
     * ID of the credit entitlement.
     */
    #[Required('credit_entitlement_id')]
    public string $creditEntitlementID;

    /**
     * Name of the credit entitlement.
     */
    #[Required('credit_entitlement_name')]
    public string $creditEntitlementName;

    /**
     * Unit label (e.g. "API Calls", "Tokens").
     */
    #[Required('credit_entitlement_unit')]
    public string $creditEntitlementUnit;

    /**
     * Number of credits granted.
     */
    #[Required('credits_amount')]
    public string $creditsAmount;

    /**
     * `new CreditEntitlement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditEntitlement::with(
     *   creditEntitlementID: ...,
     *   creditEntitlementName: ...,
     *   creditEntitlementUnit: ...,
     *   creditsAmount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditEntitlement)
     *   ->withCreditEntitlementID(...)
     *   ->withCreditEntitlementName(...)
     *   ->withCreditEntitlementUnit(...)
     *   ->withCreditsAmount(...)
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
        string $creditEntitlementName,
        string $creditEntitlementUnit,
        string $creditsAmount,
    ): self {
        $self = new self;

        $self['creditEntitlementID'] = $creditEntitlementID;
        $self['creditEntitlementName'] = $creditEntitlementName;
        $self['creditEntitlementUnit'] = $creditEntitlementUnit;
        $self['creditsAmount'] = $creditsAmount;

        return $self;
    }

    /**
     * ID of the credit entitlement.
     */
    public function withCreditEntitlementID(string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }

    /**
     * Name of the credit entitlement.
     */
    public function withCreditEntitlementName(
        string $creditEntitlementName
    ): self {
        $self = clone $this;
        $self['creditEntitlementName'] = $creditEntitlementName;

        return $self;
    }

    /**
     * Unit label (e.g. "API Calls", "Tokens").
     */
    public function withCreditEntitlementUnit(
        string $creditEntitlementUnit
    ): self {
        $self = clone $this;
        $self['creditEntitlementUnit'] = $creditEntitlementUnit;

        return $self;
    }

    /**
     * Number of credits granted.
     */
    public function withCreditsAmount(string $creditsAmount): self
    {
        $self = clone $this;
        $self['creditsAmount'] = $creditsAmount;

        return $self;
    }
}
