<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\IntegrationConfig;

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

    /**
     * Files attached to this entitlement. Add files via
     * `POST /entitlements/{id}/files` and remove them via
     * `DELETE /entitlements/{id}/files/{file_id}`.
     *
     * @var list<string> $digitalFileIDs
     */
    #[Required('digital_file_ids', list: 'string')]
    public array $digitalFileIDs;

    /**
     * Optional external URL shown to the customer alongside the files.
     */
    #[Optional('external_url', nullable: true)]
    public ?string $externalURL;

    /**
     * Optional human-readable delivery instructions shown to the customer
     * alongside the files.
     */
    #[Optional(nullable: true)]
    public ?string $instructions;

    /**
     * Three-way patchable list of legacy file identifiers:
     *
     * * omitted → preserve the current value
     * * `null`  → clear
     * * `[...]` → replace
     *
     * On create, an omitted field, an explicit `null`, or an empty
     * array all result in no legacy files attached.
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
     * Files attached to this entitlement. Add files via
     * `POST /entitlements/{id}/files` and remove them via
     * `DELETE /entitlements/{id}/files/{file_id}`.
     *
     * @param list<string> $digitalFileIDs
     */
    public function withDigitalFileIDs(array $digitalFileIDs): self
    {
        $self = clone $this;
        $self['digitalFileIDs'] = $digitalFileIDs;

        return $self;
    }

    /**
     * Optional external URL shown to the customer alongside the files.
     */
    public function withExternalURL(?string $externalURL): self
    {
        $self = clone $this;
        $self['externalURL'] = $externalURL;

        return $self;
    }

    /**
     * Optional human-readable delivery instructions shown to the customer
     * alongside the files.
     */
    public function withInstructions(?string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * Three-way patchable list of legacy file identifiers:
     *
     * * omitted → preserve the current value
     * * `null`  → clear
     * * `[...]` → replace
     *
     * On create, an omitted field, an explicit `null`, or an empty
     * array all result in no legacy files attached.
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
