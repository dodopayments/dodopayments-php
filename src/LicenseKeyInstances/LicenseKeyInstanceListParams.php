<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeyInstances;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new LicenseKeyInstanceListParams); // set properties as needed
 * $client->licenseKeyInstances->list(...$params->toArray());
 * ```.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->licenseKeyInstances->list(...$params->toArray());`
 *
 * @see Dodopayments\LicenseKeyInstances->list
 *
 * @phpstan-type license_key_instance_list_params = array{
 *   licenseKeyID?: string|null, pageNumber?: int|null, pageSize?: int|null
 * }
 */
final class LicenseKeyInstanceListParams implements BaseModel
{
    /** @use SdkModel<license_key_instance_list_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by license key ID.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $licenseKeyID;

    /**
     * Page number default is 0.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $pageNumber;

    /**
     * Page size default is 10 max is 100.
     */
    #[Api(nullable: true, optional: true)]
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
        $obj = new self;

        null !== $licenseKeyID && $obj->licenseKeyID = $licenseKeyID;
        null !== $pageNumber && $obj->pageNumber = $pageNumber;
        null !== $pageSize && $obj->pageSize = $pageSize;

        return $obj;
    }

    /**
     * Filter by license key ID.
     */
    public function withLicenseKeyID(?string $licenseKeyID): self
    {
        $obj = clone $this;
        $obj->licenseKeyID = $licenseKeyID;

        return $obj;
    }

    /**
     * Page number default is 0.
     */
    public function withPageNumber(?int $pageNumber): self
    {
        $obj = clone $this;
        $obj->pageNumber = $pageNumber;

        return $obj;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function withPageSize(?int $pageSize): self
    {
        $obj = clone $this;
        $obj->pageSize = $pageSize;

        return $obj;
    }
}
