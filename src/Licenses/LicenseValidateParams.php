<?php

declare(strict_types=1);

namespace Dodopayments\Licenses;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new LicenseValidateParams); // set properties as needed
 * $client->licenses->validate(...$params->toArray());
 * ```.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->licenses->validate(...$params->toArray());`
 *
 * @see Dodopayments\Licenses->validate
 *
 * @phpstan-type license_validate_params = array{
 *   licenseKey: string, licenseKeyInstanceID?: string|null
 * }
 */
final class LicenseValidateParams implements BaseModel
{
    /** @use SdkModel<license_validate_params> */
    use SdkModel;
    use SdkParams;

    #[Api('license_key')]
    public string $licenseKey;

    #[Api('license_key_instance_id', nullable: true, optional: true)]
    public ?string $licenseKeyInstanceID;

    /**
     * `new LicenseValidateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseValidateParams::with(licenseKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseValidateParams)->withLicenseKey(...)
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
        string $licenseKey,
        ?string $licenseKeyInstanceID = null
    ): self {
        $obj = new self;

        $obj->licenseKey = $licenseKey;

        null !== $licenseKeyInstanceID && $obj->licenseKeyInstanceID = $licenseKeyInstanceID;

        return $obj;
    }

    public function withLicenseKey(string $licenseKey): self
    {
        $obj = clone $this;
        $obj->licenseKey = $licenseKey;

        return $obj;
    }

    public function withLicenseKeyInstanceID(
        ?string $licenseKeyInstanceID
    ): self {
        $obj = clone $this;
        $obj->licenseKeyInstanceID = $licenseKeyInstanceID;

        return $obj;
    }
}
