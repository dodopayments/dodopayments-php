<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\EntitlementNewResponse\IntegrationConfig;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Entitlements\EntitlementNewResponse\IntegrationConfig\DigitalFilesConfig\DigitalFiles;

/**
 * @phpstan-import-type DigitalFilesShape from \Dodopayments\Entitlements\EntitlementNewResponse\IntegrationConfig\DigitalFilesConfig\DigitalFiles
 *
 * @phpstan-type DigitalFilesConfigShape = array{
 *   digitalFiles: DigitalFiles|DigitalFilesShape
 * }
 */
final class DigitalFilesConfig implements BaseModel
{
    /** @use SdkModel<DigitalFilesConfigShape> */
    use SdkModel;

    /**
     * Populated digital-files payload for entitlement read surfaces. Mirrors
     * `DigitalProductDelivery` but is sourced from an entitlement's
     * `integration_config` (not a grant) and tags each file with its origin
     * (`legacy` vs `ee`).
     */
    #[Required('digital_files')]
    public DigitalFiles $digitalFiles;

    /**
     * `new DigitalFilesConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalFilesConfig::with(digitalFiles: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalFilesConfig)->withDigitalFiles(...)
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
     *
     * @param DigitalFiles|DigitalFilesShape $digitalFiles
     */
    public static function with(DigitalFiles|array $digitalFiles): self
    {
        $self = new self;

        $self['digitalFiles'] = $digitalFiles;

        return $self;
    }

    /**
     * Populated digital-files payload for entitlement read surfaces. Mirrors
     * `DigitalProductDelivery` but is sourced from an entitlement's
     * `integration_config` (not a grant) and tags each file with its origin
     * (`legacy` vs `ee`).
     *
     * @param DigitalFiles|DigitalFilesShape $digitalFiles
     */
    public function withDigitalFiles(DigitalFiles|array $digitalFiles): self
    {
        $self = clone $this;
        $self['digitalFiles'] = $digitalFiles;

        return $self;
    }
}
