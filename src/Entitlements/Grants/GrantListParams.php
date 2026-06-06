<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\Grants;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Entitlements\Grants\GrantListParams\IntegrationType;
use Dodopayments\Entitlements\Grants\GrantListParams\Status;

/**
 * GET /entitlements/{id}/grants (public API).
 *
 * @see Dodopayments\Services\Entitlements\GrantsService::list()
 *
 * @phpstan-type GrantListParamsShape = array{
 *   customerID?: string|null,
 *   integrationType?: null|IntegrationType|value-of<IntegrationType>,
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
     * Filter by integration type.
     *
     * @var value-of<IntegrationType>|null $integrationType
     */
    #[Optional(enum: IntegrationType::class)]
    public ?string $integrationType;

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
     * @param IntegrationType|value-of<IntegrationType>|null $integrationType
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $customerID = null,
        IntegrationType|string|null $integrationType = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $customerID && $self['customerID'] = $customerID;
        null !== $integrationType && $self['integrationType'] = $integrationType;
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
     * Filter by integration type.
     *
     * @param IntegrationType|value-of<IntegrationType> $integrationType
     */
    public function withIntegrationType(
        IntegrationType|string $integrationType
    ): self {
        $self = clone $this;
        $self['integrationType'] = $integrationType;

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
