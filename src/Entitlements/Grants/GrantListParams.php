<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\Grants;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Entitlements\Grants\GrantListParams\Status;

/**
 * GET /entitlements/{id}/grants (public API).
 *
 * @see Dodopayments\Services\Entitlements\GrantsService::list()
 *
 * @phpstan-type GrantListParamsShape = array{
 *   customerID?: string|null,
 *   pageNumber?: int|null,
 *   pageSize?: int|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class GrantListParams implements BaseModel
{
    /** @use SdkModel<GrantListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by customer ID.
     */
    #[Optional]
    public ?string $customerID;

    /**
     * Page number (default 0).
     */
    #[Optional]
    public ?int $pageNumber;

    /**
     * Page size (default 10, max 100).
     */
    #[Optional]
    public ?int $pageSize;

    /**
     * Filter by grant status.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

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
        ?string $customerID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $customerID && $self['customerID'] = $customerID;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Filter by customer ID.
     */
    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * Page number (default 0).
     */
    public function withPageNumber(int $pageNumber): self
    {
        $self = clone $this;
        $self['pageNumber'] = $pageNumber;

        return $self;
    }

    /**
     * Page size (default 10, max 100).
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Filter by grant status.
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
