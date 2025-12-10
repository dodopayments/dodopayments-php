<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeyInstances;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\LicenseKeyInstancesService::list()
 *
 * @phpstan-type LicenseKeyInstanceListParamsShape = array{
 *   licenseKeyID?: string|null, pageNumber?: int|null, pageSize?: int|null
 * }
 */
final class LicenseKeyInstanceListParams implements BaseModel
{
    /** @use SdkModel<LicenseKeyInstanceListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by license key ID.
     */
    #[Optional(nullable: true)]
    public ?string $licenseKeyID;

    /**
     * Page number default is 0.
     */
    #[Optional(nullable: true)]
    public ?int $pageNumber;

    /**
     * Page size default is 10 max is 100.
     */
    #[Optional(nullable: true)]
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
        ?string $licenseKeyID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null
    ): self {
        $self = new self;

        null !== $licenseKeyID && $self['licenseKeyID'] = $licenseKeyID;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Filter by license key ID.
     */
    public function withLicenseKeyID(?string $licenseKeyID): self
    {
        $self = clone $this;
        $self['licenseKeyID'] = $licenseKeyID;

        return $self;
    }

    /**
     * Page number default is 0.
     */
    public function withPageNumber(?int $pageNumber): self
    {
        $self = clone $this;
        $self['pageNumber'] = $pageNumber;

        return $self;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function withPageSize(?int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }
}
