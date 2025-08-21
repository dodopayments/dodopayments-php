<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\Headers;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\MapOf;

/**
 * Patch a webhook by id.
 *
 * @phpstan-type update_params = array{headers: array<string, string>}
 */
final class HeaderUpdateParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    /**
     * Object of header-value pair to update or add.
     *
     * @var array<string, string> $headers
     */
    #[Api(type: new MapOf('string'))]
    public array $headers;

    /**
     * `new HeaderUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * HeaderUpdateParams::with(headers: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new HeaderUpdateParams)->withHeaders(...)
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
     *
     * @param array<string, string> $headers
     */
    public static function with(array $headers): self
    {
        $obj = new self;

        $obj->headers = $headers;

        return $obj;
    }

    /**
     * Object of header-value pair to update or add.
     *
     * @param array<string, string> $headers
     */
    public function withHeaders(array $headers): self
    {
        $obj = clone $this;
        $obj->headers = $headers;

        return $obj;
    }
}
