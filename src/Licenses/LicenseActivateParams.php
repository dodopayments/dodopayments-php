<?php

declare(strict_types=1);

namespace DodopaymentsClient\Licenses;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Concerns\Params;
use DodopaymentsClient\Core\Contracts\BaseModel;

/**
 * @phpstan-type activate_params = array{licenseKey: string, name: string}
 */
final class LicenseActivateParams implements BaseModel
{
    use Model;
    use Params;

    #[Api('license_key')]
    public string $licenseKey;

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
    public static function from(string $licenseKey, string $name): self
    {
        $obj = new self;

        $obj->licenseKey = $licenseKey;
        $obj->name = $name;

        return $obj;
    }

    public function setLicenseKey(string $licenseKey): self
    {
        $this->licenseKey = $licenseKey;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
