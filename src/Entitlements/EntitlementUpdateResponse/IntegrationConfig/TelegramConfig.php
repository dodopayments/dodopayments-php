<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\EntitlementUpdateResponse\IntegrationConfig;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type TelegramConfigShape = array{chatID: string}
 */
final class TelegramConfig implements BaseModel
{
    /** @use SdkModel<TelegramConfigShape> */
    use SdkModel;

    #[Required('chat_id')]
    public string $chatID;

    /**
     * `new TelegramConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TelegramConfig::with(chatID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TelegramConfig)->withChatID(...)
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
    public static function with(string $chatID): self
    {
        $self = new self;

        $self['chatID'] = $chatID;

        return $self;
    }

    public function withChatID(string $chatID): self
    {
        $self = clone $this;
        $self['chatID'] = $chatID;

        return $self;
    }
}
