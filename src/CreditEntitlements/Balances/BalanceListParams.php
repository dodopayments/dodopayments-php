<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements\Balances;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Returns a paginated list of customer credit balances for the given credit entitlement.
 *
 * # Authentication
 * Requires an API key with `Viewer` role or higher.
 *
 * # Path Parameters
 * - `credit_entitlement_id` - The unique identifier of the credit entitlement
 *
 * # Query Parameters
 * - `page_size` - Number of items per page (default: 10, max: 100)
 * - `page_number` - Zero-based page number (default: 0)
 * - `customer_id` - Optional filter by specific customer
 *
 * # Responses
 * - `200 OK` - Returns list of customer balances
 * - `404 Not Found` - Credit entitlement not found
 * - `500 Internal Server Error` - Database or server error
 *
 * @see Dodopayments\Services\CreditEntitlements\BalancesService::list()
 *
 * @phpstan-type BalanceListParamsShape = array{
 *   customerID?: string|null, pageNumber?: int|null, pageSize?: int|null
 * }
 */
final class BalanceListParams implements BaseModel
{
    /** @use SdkModel<BalanceListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by specific customer ID.
     */
    #[Optional]
    public ?string $customerID;

    /**
     * Page number default is 0.
     */
    #[Optional]
    public ?int $pageNumber;

    /**
     * Page size default is 10 max is 100.
     */
    #[Optional]
    public ?int $pageSize;

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
        ?string $customerID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null
    ): self {
        $self = new self;

        null !== $customerID && $self['customerID'] = $customerID;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Filter by specific customer ID.
     */
    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * Page number default is 0.
     */
    public function withPageNumber(int $pageNumber): self
    {
        $self = clone $this;
        $self['pageNumber'] = $pageNumber;

        return $self;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }
}
