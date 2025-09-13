<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\Headers;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * The value of the headers is returned in the `headers` field.
 *
 * Sensitive headers that have been redacted are returned in the sensitive
 * field.
 *
 * @phpstan-type header_get_response = array{
 *   headers: array<string, string>, sensitive: list<string>
 * }
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class HeaderGetResponse implements BaseModel
{
    /** @use SdkModel<header_get_response> */
    use SdkModel;

    /**
     * List of headers configured.
     *
     * @var array<string, string> $headers
     */
    #[Api(map: 'string')]
    public array $headers;

    /**
     * Sensitive headers without the value.
     *
     * @var list<string> $sensitive
     */
    #[Api(list: 'string')]
    public array $sensitive;

    /**
     * `new HeaderGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * HeaderGetResponse::with(headers: ..., sensitive: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new HeaderGetResponse)->withHeaders(...)->withSensitive(...)
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
     * @param array<string, string> $headers
     * @param list<string> $sensitive
     */
    public static function with(array $headers, array $sensitive): self
    {
        $obj = new self;

        $obj->headers = $headers;
        $obj->sensitive = $sensitive;

        return $obj;
    }

    /**
     * List of headers configured.
     *
     * @param array<string, string> $headers
     */
    public function withHeaders(array $headers): self
    {
        $obj = clone $this;
        $obj->headers = $headers;

        return $obj;
    }

    /**
     * Sensitive headers without the value.
     *
     * @param list<string> $sensitive
     */
    public function withSensitive(array $sensitive): self
    {
        $obj = clone $this;
        $obj->sensitive = $sensitive;

        return $obj;
    }
}
