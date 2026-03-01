<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements\Balances;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Returns a paginated list of credit transaction history with optional filtering.
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
 * - `transaction_type` - Filter by transaction type
 * - `start_date` - Filter entries from this date
 * - `end_date` - Filter entries until this date
 *
 * # Responses
 * - `200 OK` - Returns list of ledger entries
 * - `404 Not Found` - Credit entitlement not found
 * - `500 Internal Server Error` - Database or server error
 *
 * @see Dodopayments\Services\CreditEntitlements\BalancesService::listLedger()
 *
 * @phpstan-type BalanceListLedgerParamsShape = array{
 *   creditEntitlementID: string,
 *   endDate?: \DateTimeInterface|null,
 *   pageNumber?: int|null,
 *   pageSize?: int|null,
 *   startDate?: \DateTimeInterface|null,
 *   transactionType?: string|null,
 * }
 */
final class BalanceListLedgerParams implements BaseModel
{
    /** @use SdkModel<BalanceListLedgerParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $creditEntitlementID;

    /**
     * Filter by end date.
     */
    #[Optional]
    public ?\DateTimeInterface $endDate;

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
     * Filter by start date.
     */
    #[Optional]
    public ?\DateTimeInterface $startDate;

    /**
     * Filter by transaction type (snake_case: credit_added, credit_deducted, credit_expired, etc.).
     */
    #[Optional]
    public ?string $transactionType;

    /**
     * `new BalanceListLedgerParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BalanceListLedgerParams::with(creditEntitlementID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BalanceListLedgerParams)->withCreditEntitlementID(...)
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
        ?\DateTimeInterface $endDate = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?\DateTimeInterface $startDate = null,
        ?string $transactionType = null,
    ): self {
        $self = new self;

        $self['creditEntitlementID'] = $creditEntitlementID;

        null !== $endDate && $self['endDate'] = $endDate;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;
        null !== $startDate && $self['startDate'] = $startDate;
        null !== $transactionType && $self['transactionType'] = $transactionType;

        return $self;
    }

    public function withCreditEntitlementID(string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }

    /**
     * Filter by end date.
     */
    public function withEndDate(\DateTimeInterface $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

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
     * Filter by start date.
     */
    public function withStartDate(\DateTimeInterface $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }

    /**
     * Filter by transaction type (snake_case: credit_added, credit_deducted, credit_expired, etc.).
     */
    public function withTransactionType(string $transactionType): self
    {
        $self = clone $this;
        $self['transactionType'] = $transactionType;

        return $self;
    }
}
