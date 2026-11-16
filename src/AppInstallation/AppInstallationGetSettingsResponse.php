<?php

declare(strict_types=1);

namespace Dodopayments\AppInstallation;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * The settings of the App Installation of the app token, with the secret values.
 *
 * @phpstan-type AppInstallationGetSettingsResponseShape = array{
 *   actionNeeded: bool,
 *   appID: string,
 *   installationID: string,
 *   invalidKeys: list<string>,
 *   secrets: mixed,
 *   values: mixed,
 *   liveManifestVersion?: int|null,
 *   manifestVersion?: int|null,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class AppInstallationGetSettingsResponse implements BaseModel
{
    /** @use SdkModel<AppInstallationGetSettingsResponseShape> */
    use SdkModel;

    /**
     * `true` when a required field has no value, or a stored value fails a live rule.
     */
    #[Required('action_needed')]
    public bool $actionNeeded;

    #[Required('app_id')]
    public string $appID;

    #[Required('installation_id')]
    public string $installationID;

    /**
     * The keys that need an action.
     *
     * @var list<string> $invalidKeys
     */
    #[Required('invalid_keys', list: 'string')]
    public array $invalidKeys;

    /**
     * The values of the secret fields of the live manifest, by key.
     */
    #[Required]
    public mixed $secrets;

    /**
     * The values of the fields of the live manifest that are not secrets.
     */
    #[Required]
    public mixed $values;

    /**
     * The version of the live settings manifest. It is `null` when the app has no live
     * manifest. Then `values` and `secrets` are empty.
     */
    #[Optional('live_manifest_version', nullable: true)]
    public ?int $liveManifestVersion;

    /**
     * The manifest version of the last save. It is `null` when the installation has no
     * settings.
     */
    #[Optional('manifest_version', nullable: true)]
    public ?int $manifestVersion;

    /**
     * The time of the last save.
     */
    #[Optional('updated_at', nullable: true)]
    public ?\DateTimeInterface $updatedAt;

    /**
     * `new AppInstallationGetSettingsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AppInstallationGetSettingsResponse::with(
     *   actionNeeded: ...,
     *   appID: ...,
     *   installationID: ...,
     *   invalidKeys: ...,
     *   secrets: ...,
     *   values: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AppInstallationGetSettingsResponse)
     *   ->withActionNeeded(...)
     *   ->withAppID(...)
     *   ->withInstallationID(...)
     *   ->withInvalidKeys(...)
     *   ->withSecrets(...)
     *   ->withValues(...)
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
     * @param list<string> $invalidKeys
     */
    public static function with(
        bool $actionNeeded,
        string $appID,
        string $installationID,
        array $invalidKeys,
        mixed $secrets,
        mixed $values,
        ?int $liveManifestVersion = null,
        ?int $manifestVersion = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $self = new self;

        $self['actionNeeded'] = $actionNeeded;
        $self['appID'] = $appID;
        $self['installationID'] = $installationID;
        $self['invalidKeys'] = $invalidKeys;
        $self['secrets'] = $secrets;
        $self['values'] = $values;

        null !== $liveManifestVersion && $self['liveManifestVersion'] = $liveManifestVersion;
        null !== $manifestVersion && $self['manifestVersion'] = $manifestVersion;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * `true` when a required field has no value, or a stored value fails a live rule.
     */
    public function withActionNeeded(bool $actionNeeded): self
    {
        $self = clone $this;
        $self['actionNeeded'] = $actionNeeded;

        return $self;
    }

    public function withAppID(string $appID): self
    {
        $self = clone $this;
        $self['appID'] = $appID;

        return $self;
    }

    public function withInstallationID(string $installationID): self
    {
        $self = clone $this;
        $self['installationID'] = $installationID;

        return $self;
    }

    /**
     * The keys that need an action.
     *
     * @param list<string> $invalidKeys
     */
    public function withInvalidKeys(array $invalidKeys): self
    {
        $self = clone $this;
        $self['invalidKeys'] = $invalidKeys;

        return $self;
    }

    /**
     * The values of the secret fields of the live manifest, by key.
     */
    public function withSecrets(mixed $secrets): self
    {
        $self = clone $this;
        $self['secrets'] = $secrets;

        return $self;
    }

    /**
     * The values of the fields of the live manifest that are not secrets.
     */
    public function withValues(mixed $values): self
    {
        $self = clone $this;
        $self['values'] = $values;

        return $self;
    }

    /**
     * The version of the live settings manifest. It is `null` when the app has no live
     * manifest. Then `values` and `secrets` are empty.
     */
    public function withLiveManifestVersion(?int $liveManifestVersion): self
    {
        $self = clone $this;
        $self['liveManifestVersion'] = $liveManifestVersion;

        return $self;
    }

    /**
     * The manifest version of the last save. It is `null` when the installation has no
     * settings.
     */
    public function withManifestVersion(?int $manifestVersion): self
    {
        $self = clone $this;
        $self['manifestVersion'] = $manifestVersion;

        return $self;
    }

    /**
     * The time of the last save.
     */
    public function withUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
