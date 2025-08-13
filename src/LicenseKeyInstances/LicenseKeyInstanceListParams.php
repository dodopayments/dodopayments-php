<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeyInstances;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Concerns\Params;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type list_params = array{
 *   licenseKeyID?: string|null, pageNumber?: int|null, pageSize?: int|null
 * }
 */
final class LicenseKeyInstanceListParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Filter by license key ID.
     */
    #[Api(optional: true)]
    public ?string $licenseKeyID;

    /**
     * Page number default is 0.
     */
    #[Api(optional: true)]
    public ?int $pageNumber;

    /**
     * Page size default is 10 max is 100.
     */
    #[Api(optional: true)]
    public ?int $pageSize;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function from(
        ?string $licenseKeyID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null
    ): self {
        $obj = new self;

        null !== $licenseKeyID && $obj->licenseKeyID = $licenseKeyID;
        null !== $pageNumber && $obj->pageNumber = $pageNumber;
        null !== $pageSize && $obj->pageSize = $pageSize;

        return $obj;
    }

    /**
     * Filter by license key ID.
     */
    public function setLicenseKeyID(?string $licenseKeyID): self
    {
        $this->licenseKeyID = $licenseKeyID;

        return $this;
    }

    /**
     * Page number default is 0.
     */
    public function setPageNumber(?int $pageNumber): self
    {
        $this->pageNumber = $pageNumber;

        return $this;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function setPageSize(?int $pageSize): self
    {
        $this->pageSize = $pageSize;

        return $this;
    }
}
