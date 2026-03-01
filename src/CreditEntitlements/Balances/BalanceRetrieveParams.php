<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements\Balances;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Returns the credit balance details for a specific customer and credit entitlement.
 *
 * # Authentication
 * Requires an API key with `Viewer` role or higher.
 *
 * # Path Parameters
 * - `credit_entitlement_id` - The unique identifier of the credit entitlement
 * - `customer_id` - The unique identifier of the customer
 *
 * # Responses
 * - `200 OK` - Returns the customer's balance
 * - `404 Not Found` - Credit entitlement or customer balance not found
 * - `500 Internal Server Error` - Database or server error
 *
 * @see Dodopayments\Services\CreditEntitlements\BalancesService::retrieve()
 *
 * @phpstan-type BalanceRetrieveParamsShape = array{creditEntitlementID: string}
 */
final class BalanceRetrieveParams implements BaseModel
{
    /** @use SdkModel<BalanceRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $creditEntitlementID;

    /**
     * `new BalanceRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BalanceRetrieveParams::with(creditEntitlementID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BalanceRetrieveParams)->withCreditEntitlementID(...)
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
    public static function with(string $creditEntitlementID): self
    {
        $self = new self;

        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }

    public function withCreditEntitlementID(string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }
}
