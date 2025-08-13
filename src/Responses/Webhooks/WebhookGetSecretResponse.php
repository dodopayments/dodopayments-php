<?php

declare(strict_types=1);

namespace Dodopayments\Responses\Webhooks;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type webhook_get_secret_response_alias = array{secret: string}
 */
final class WebhookGetSecretResponse implements BaseModel
{
    use Model;

    #[Api]
    public string $secret;

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
    public static function from(string $secret): self
    {
        $obj = new self;

        $obj->secret = $secret;

        return $obj;
    }

    public function setSecret(string $secret): self
    {
        $this->secret = $secret;

        return $this;
    }
}
