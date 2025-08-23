<?php

declare(strict_types=1);

namespace Dodopayments\Responses\Webhooks;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

final class WebhookGetSecretResponse implements BaseModel
{
    use SdkModel;

    #[Api]
    public string $secret;

    /**
     * `new WebhookGetSecretResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookGetSecretResponse::with(secret: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookGetSecretResponse)->withSecret(...)
     * ```
     */
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
    public static function with(string $secret): self
    {
        $obj = new self;

        $obj->secret = $secret;

        return $obj;
    }

    public function withSecret(string $secret): self
    {
        $obj = clone $this;
        $obj->secret = $secret;

        return $obj;
    }
}
