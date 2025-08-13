<?php

declare(strict_types=1);

namespace Dodopayments\Licenses;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Concerns\Params;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type validate_params = array{
 *   licenseKey: string, licenseKeyInstanceID?: string|null
 * }
 */
final class LicenseValidateParams implements BaseModel
{
    use Model;
    use Params;

    #[Api('license_key')]
    public string $licenseKey;

    #[Api('license_key_instance_id', optional: true)]
    public ?string $licenseKeyInstanceID;

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
        string $licenseKey,
        ?string $licenseKeyInstanceID = null
    ): self {
        $obj = new self;

        $obj->licenseKey = $licenseKey;

        null !== $licenseKeyInstanceID && $obj->licenseKeyInstanceID = $licenseKeyInstanceID;

        return $obj;
    }

    public function setLicenseKey(string $licenseKey): self
    {
        $this->licenseKey = $licenseKey;

        return $this;
    }

    public function setLicenseKeyInstanceID(?string $licenseKeyInstanceID): self
    {
        $this->licenseKeyInstanceID = $licenseKeyInstanceID;

        return $this;
    }
}
