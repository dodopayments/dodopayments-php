<?php

declare(strict_types=1);

namespace Dodopayments\Products\Product\Entitlement\IntegrationConfig;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type DiscordConfigShape = array{guildID: string, roleID?: string|null}
 */
final class DiscordConfig implements BaseModel
{
    /** @use SdkModel<DiscordConfigShape> */
    use SdkModel;

    #[Required('guild_id')]
    public string $guildID;

    #[Optional('role_id', nullable: true)]
    public ?string $roleID;

    /**
     * `new DiscordConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DiscordConfig::with(guildID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DiscordConfig)->withGuildID(...)
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
    public static function with(string $guildID, ?string $roleID = null): self
    {
        $self = new self;

        $self['guildID'] = $guildID;

        null !== $roleID && $self['roleID'] = $roleID;

        return $self;
    }

    public function withGuildID(string $guildID): self
    {
        $self = clone $this;
        $self['guildID'] = $guildID;

        return $self;
    }

    public function withRoleID(?string $roleID): self
    {
        $self = clone $this;
        $self['roleID'] = $roleID;

        return $self;
    }
}
