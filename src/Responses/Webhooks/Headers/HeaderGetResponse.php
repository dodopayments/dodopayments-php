<?php

declare(strict_types=1);

namespace DodopaymentsClient\Responses\Webhooks\Headers;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Contracts\BaseModel;
use DodopaymentsClient\Core\Conversion\ListOf;
use DodopaymentsClient\Core\Conversion\MapOf;

/**
 * The value of the headers is returned in the `headers` field.
 *
 * Sensitive headers that have been redacted are returned in the sensitive
 * field.
 *
 * @phpstan-type header_get_response_alias = array{
 *   headers: array<string, string>, sensitive: list<string>
 * }
 */
final class HeaderGetResponse implements BaseModel
{
    use Model;

    /**
     * List of headers configured.
     *
     * @var array<string, string> $headers
     */
    #[Api(type: new MapOf('string'))]
    public array $headers;

    /**
     * Sensitive headers without the value.
     *
     * @var list<string> $sensitive
     */
    #[Api(type: new ListOf('string'))]
    public array $sensitive;

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
     * @param list<string> $sensitive
     */
    public static function from(array $headers, array $sensitive): self
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
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Sensitive headers without the value.
     *
     * @param list<string> $sensitive
     */
    public function setSensitive(array $sensitive): self
    {
        $this->sensitive = $sensitive;

        return $this;
    }
}
