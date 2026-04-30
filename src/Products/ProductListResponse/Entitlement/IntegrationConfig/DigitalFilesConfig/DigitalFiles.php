<?php

declare(strict_types=1);

namespace Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\DigitalFilesConfig;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\DigitalFilesConfig\DigitalFiles\File;

/**
 * Populated digital-files payload for entitlement read surfaces. Mirrors
 * `DigitalProductDelivery` but is sourced from an entitlement's
 * `integration_config` (not a grant) and tags each file with its origin
 * (`legacy` vs `ee`).
 *
 * @phpstan-import-type FileShape from \Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig\DigitalFilesConfig\DigitalFiles\File
 *
 * @phpstan-type DigitalFilesShape = array{
 *   files: list<File|FileShape>,
 *   externalURL?: string|null,
 *   instructions?: string|null,
 * }
 */
final class DigitalFiles implements BaseModel
{
    /** @use SdkModel<DigitalFilesShape> */
    use SdkModel;

    /** @var list<File> $files */
    #[Required(list: File::class)]
    public array $files;

    #[Optional('external_url', nullable: true)]
    public ?string $externalURL;

    #[Optional(nullable: true)]
    public ?string $instructions;

    /**
     * `new DigitalFiles()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalFiles::with(files: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalFiles)->withFiles(...)
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
     * @param list<File|FileShape> $files
     */
    public static function with(
        array $files,
        ?string $externalURL = null,
        ?string $instructions = null
    ): self {
        $self = new self;

        $self['files'] = $files;

        null !== $externalURL && $self['externalURL'] = $externalURL;
        null !== $instructions && $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * @param list<File|FileShape> $files
     */
    public function withFiles(array $files): self
    {
        $self = clone $this;
        $self['files'] = $files;

        return $self;
    }

    public function withExternalURL(?string $externalURL): self
    {
        $self = clone $this;
        $self['externalURL'] = $externalURL;

        return $self;
    }

    public function withInstructions(?string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }
}
