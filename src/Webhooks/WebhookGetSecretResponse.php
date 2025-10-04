<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type webhook_get_secret_response = array{secret: string}
 */
final class WebhookGetSecretResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<webhook_get_secret_response> */
    use SdkModel;

    use SdkResponse;

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
        $this->initialize();
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
