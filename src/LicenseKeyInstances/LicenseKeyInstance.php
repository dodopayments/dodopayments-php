<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeyInstances;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type LicenseKeyInstanceShape = array{
 *   id: string,
 *   business_id: string,
 *   created_at: \DateTimeInterface,
 *   license_key_id: string,
 *   name: string,
 * }
 */
final class LicenseKeyInstance implements BaseModel
{
    /** @use SdkModel<LicenseKeyInstanceShape> */
    use SdkModel;

    #[Api]
    public string $id;

    #[Api]
    public string $business_id;

    #[Api]
    public \DateTimeInterface $created_at;

    #[Api]
    public string $license_key_id;

    #[Api]
    public string $name;

    /**
     * `new LicenseKeyInstance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseKeyInstance::with(
     *   id: ..., business_id: ..., created_at: ..., license_key_id: ..., name: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseKeyInstance)
     *   ->withID(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withLicenseKeyID(...)
     *   ->withName(...)
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
        string $id,
        string $business_id,
        \DateTimeInterface $created_at,
        string $license_key_id,
        string $name,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['business_id'] = $business_id;
        $obj['created_at'] = $created_at;
        $obj['license_key_id'] = $license_key_id;
        $obj['name'] = $name;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['business_id'] = $businessID;

        return $obj;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    public function withLicenseKeyID(string $licenseKeyID): self
    {
        $obj = clone $this;
        $obj['license_key_id'] = $licenseKeyID;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }
}
