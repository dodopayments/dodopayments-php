<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeyInstances;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type LicenseKeyInstanceShape = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   licenseKeyID: string,
 *   name: string,
 * }
 */
final class LicenseKeyInstance implements BaseModel
{
    /** @use SdkModel<LicenseKeyInstanceShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('business_id')]
    public string $businessID;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('license_key_id')]
    public string $licenseKeyID;

    #[Required]
    public string $name;

    /**
     * `new LicenseKeyInstance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseKeyInstance::with(
     *   id: ..., businessID: ..., createdAt: ..., licenseKeyID: ..., name: ...
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
        string $businessID,
        \DateTimeInterface $createdAt,
        string $licenseKeyID,
        string $name,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['licenseKeyID'] = $licenseKeyID;
        $self['name'] = $name;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withLicenseKeyID(string $licenseKeyID): self
    {
        $self = clone $this;
        $self['licenseKeyID'] = $licenseKeyID;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
