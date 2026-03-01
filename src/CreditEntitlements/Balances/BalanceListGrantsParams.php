<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements\Balances;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\CreditEntitlements\Balances\BalanceListGrantsParams\Status;

/**
 * Returns a paginated list of credit grants with optional filtering by status.
 *
 * # Authentication
 * Requires an API key with `Viewer` role or higher.
 *
 * # Path Parameters
 * - `credit_entitlement_id` - The unique identifier of the credit entitlement
 * - `customer_id` - The unique identifier of the customer
 *
 * # Query Parameters
 * - `page_size` - Number of items per page (default: 10, max: 100)
 * - `page_number` - Zero-based page number (default: 0)
 * - `status` - Filter by status: active, expired, depleted
 *
 * # Responses
 * - `200 OK` - Returns list of grants
 * - `404 Not Found` - Credit entitlement not found
 * - `500 Internal Server Error` - Database or server error
 *
 * @see Dodopayments\Services\CreditEntitlements\BalancesService::listGrants()
 *
 * @phpstan-type BalanceListGrantsParamsShape = array{
 *   creditEntitlementID: string,
 *   pageNumber?: int|null,
 *   pageSize?: int|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class BalanceListGrantsParams implements BaseModel
{
    /** @use SdkModel<BalanceListGrantsParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $creditEntitlementID;

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

    /**
     * Filter by grant status: active, expired, depleted.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * `new BalanceListGrantsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BalanceListGrantsParams::with(creditEntitlementID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BalanceListGrantsParams)->withCreditEntitlementID(...)
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
     *
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        string $creditEntitlementID,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        $self['creditEntitlementID'] = $creditEntitlementID;

        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    public function withCreditEntitlementID(string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

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

    /**
     * Filter by grant status: active, expired, depleted.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
