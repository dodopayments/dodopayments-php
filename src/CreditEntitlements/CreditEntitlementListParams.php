<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Returns a paginated list of credit entitlements, allowing filtering of deleted
 * entitlements. By default, only non-deleted entitlements are returned.
 *
 * # Authentication
 * Requires an API key with `Viewer` role or higher.
 *
 * # Query Parameters
 * - `page_size` - Number of items per page (default: 10, max: 100)
 * - `page_number` - Zero-based page number (default: 0)
 * - `deleted` - Boolean flag to list deleted entitlements instead of active ones (default: false)
 *
 * # Responses
 * - `200 OK` - Returns a list of credit entitlements wrapped in a response object
 * - `422 Unprocessable Entity` - Invalid query parameters (e.g., page_size > 100)
 * - `500 Internal Server Error` - Database or server error
 *
 * # Business Logic
 * - Results are ordered by creation date in descending order (newest first)
 * - Only entitlements belonging to the authenticated business are returned
 * - The `deleted` parameter controls visibility of soft-deleted entitlements
 * - Pagination uses offset-based pagination (offset = page_number * page_size)
 *
 * @see Dodopayments\Services\CreditEntitlementsService::list()
 *
 * @phpstan-type CreditEntitlementListParamsShape = array{
 *   deleted?: bool|null, pageNumber?: int|null, pageSize?: int|null
 * }
 */
final class CreditEntitlementListParams implements BaseModel
{
    /** @use SdkModel<CreditEntitlementListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * List deleted credit entitlements.
     */
    #[Optional]
    public ?bool $deleted;

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
        ?bool $deleted = null,
        ?int $pageNumber = null,
        ?int $pageSize = null
    ): self {
        $self = new self;

        null !== $deleted && $self['deleted'] = $deleted;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * List deleted credit entitlements.
     */
    public function withDeleted(bool $deleted): self
    {
        $self = clone $this;
        $self['deleted'] = $deleted;

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
