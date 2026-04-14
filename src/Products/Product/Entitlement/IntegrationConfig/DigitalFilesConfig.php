<?php

declare(strict_types=1);

namespace Dodopayments\Products\Product\Entitlement\IntegrationConfig;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type DigitalFilesConfigShape = array{
 *   digitalFileIDs: list<string>,
 *   externalURL?: string|null,
 *   instructions?: string|null,
 * }
 */
final class DigitalFilesConfig implements BaseModel
{
    /** @use SdkModel<DigitalFilesConfigShape> */
    use SdkModel;

    /** @var list<string> $digitalFileIDs */
    #[Required('digital_file_ids', list: 'string')]
    public array $digitalFileIDs;

    #[Optional('external_url', nullable: true)]
    public ?string $externalURL;

    #[Optional(nullable: true)]
    public ?string $instructions;

    /**
     * `new DigitalFilesConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalFilesConfig::with(digitalFileIDs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalFilesConfig)->withDigitalFileIDs(...)
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
     * @param list<string> $digitalFileIDs
     */
    public static function with(
        array $digitalFileIDs,
        ?string $externalURL = null,
        ?string $instructions = null,
    ): self {
        $self = new self;

        $self['digitalFileIDs'] = $digitalFileIDs;

        null !== $externalURL && $self['externalURL'] = $externalURL;
        null !== $instructions && $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * @param list<string> $digitalFileIDs
     */
    public function withDigitalFileIDs(array $digitalFileIDs): self
    {
        $self = clone $this;
        $self['digitalFileIDs'] = $digitalFileIDs;

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
