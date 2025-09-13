<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeyInstances;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type license_key_instance = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   licenseKeyID: string,
 *   name: string,
 * }
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class LicenseKeyInstance implements BaseModel
{
    /** @use SdkModel<license_key_instance> */
    use SdkModel;

    #[Api]
    public string $id;

    #[Api('business_id')]
    public string $businessID;

    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    #[Api('license_key_id')]
    public string $licenseKeyID;

    #[Api]
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
        $obj = new self;

        $obj->id = $id;
        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->licenseKeyID = $licenseKeyID;
        $obj->name = $name;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    public function withLicenseKeyID(string $licenseKeyID): self
    {
        $obj = clone $this;
        $obj->licenseKeyID = $licenseKeyID;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }
}
