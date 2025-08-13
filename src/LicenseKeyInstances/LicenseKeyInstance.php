<?php

declare(strict_types=1);

namespace DodopaymentsClient\LicenseKeyInstances;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Contracts\BaseModel;

/**
 * @phpstan-type license_key_instance_alias = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   licenseKeyID: string,
 *   name: string,
 * }
 */
final class LicenseKeyInstance implements BaseModel
{
    use Model;

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

    public function setID(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setBusinessID(string $businessID): self
    {
        $this->businessID = $businessID;

        return $this;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setLicenseKeyID(string $licenseKeyID): self
    {
        $this->licenseKeyID = $licenseKeyID;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
