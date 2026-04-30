<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\EntitlementUpdateParams\IntegrationConfig;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type DigitalFilesConfigShape = array{
 *   digitalFileIDs: list<string>,
 *   externalURL?: string|null,
 *   instructions?: string|null,
 *   legacyFileIDs?: list<string>|null,
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
     * Three-way patchable field (mirrors the credit_entitlements pattern):
     *
     * * omitted → preserve persisted (`None`)
     * * `null`  → clear              (`Some(None)`)
     * * `[...]` → replace            (`Some(Some(...))`)
     *
     * On Create / storage we collapse "clear" and empty-array to `None`
     * so the persisted JSONB never carries a `null` legacy_file_ids key.
     *
     * @var list<string>|null $legacyFileIDs
     */
    #[Optional('legacy_file_ids', list: 'string', nullable: true)]
    public ?array $legacyFileIDs;

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
     * @param list<string>|null $legacyFileIDs
     */
    public static function with(
        array $digitalFileIDs,
        ?string $externalURL = null,
        ?string $instructions = null,
        ?array $legacyFileIDs = null,
    ): self {
        $self = new self;

        $self['digitalFileIDs'] = $digitalFileIDs;

        null !== $externalURL && $self['externalURL'] = $externalURL;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $legacyFileIDs && $self['legacyFileIDs'] = $legacyFileIDs;

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

    /**
     * Three-way patchable field (mirrors the credit_entitlements pattern):
     *
     * * omitted → preserve persisted (`None`)
     * * `null`  → clear              (`Some(None)`)
     * * `[...]` → replace            (`Some(Some(...))`)
     *
     * On Create / storage we collapse "clear" and empty-array to `None`
     * so the persisted JSONB never carries a `null` legacy_file_ids key.
     *
     * @param list<string>|null $legacyFileIDs
     */
    public function withLegacyFileIDs(?array $legacyFileIDs): self
    {
        $self = clone $this;
        $self['legacyFileIDs'] = $legacyFileIDs;

        return $self;
    }
}
