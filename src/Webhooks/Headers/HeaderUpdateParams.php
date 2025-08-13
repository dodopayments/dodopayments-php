<?php

declare(strict_types=1);

namespace DodoPayments\Webhooks\Headers;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Core\Conversion\MapOf;

/**
 * Patch a webhook by id.
 *
 * @phpstan-type update_params = array{headers: array<string, string>}
 */
final class HeaderUpdateParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Object of header-value pair to update or add.
     *
     * @var array<string, string> $headers
     */
    #[Api(type: new MapOf('string'))]
    public array $headers;

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
    public static function from(array $headers): self
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
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }
}
