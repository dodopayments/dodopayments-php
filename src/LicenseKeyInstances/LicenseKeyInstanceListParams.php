<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeyInstances;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\LicenseKeyInstances->list
 *
 * @phpstan-type LicenseKeyInstanceListParamsShape = array{
 *   license_key_id?: string|null, page_number?: int|null, page_size?: int|null
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
    #[Api(nullable: true, optional: true)]
    public ?string $license_key_id;

    /**
     * Page number default is 0.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $page_number;

    /**
     * Page size default is 10 max is 100.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $page_size;

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
        ?string $license_key_id = null,
        ?int $page_number = null,
        ?int $page_size = null,
    ): self {
        $obj = new self;

        null !== $license_key_id && $obj->license_key_id = $license_key_id;
        null !== $page_number && $obj->page_number = $page_number;
        null !== $page_size && $obj->page_size = $page_size;

        return $obj;
    }

    /**
     * Filter by license key ID.
     */
    public function withLicenseKeyID(?string $licenseKeyID): self
    {
        $obj = clone $this;
        $obj->license_key_id = $licenseKeyID;

        return $obj;
    }

    /**
     * Page number default is 0.
     */
    public function withPageNumber(?int $pageNumber): self
    {
        $obj = clone $this;
        $obj->page_number = $pageNumber;

        return $obj;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function withPageSize(?int $pageSize): self
    {
        $obj = clone $this;
        $obj->page_size = $pageSize;

        return $obj;
    }
}
